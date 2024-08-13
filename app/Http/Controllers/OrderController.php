<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'products'])->get();
        return view('dashboard.orders.index', compact('orders'));
    }

    public function indexOrder(Request $request)
    {
        $cart = Session::get('cart', []);
        $selectedProductIds = array_keys($cart);
        $selectedProducts = collect();

        if (!empty($selectedProductIds)) {
            $selectedProducts = Product::whereIn('id', $selectedProductIds)->get();
        }

        return view('pages.orderPage', compact('selectedProducts', 'cart'));
    }

    public function create(Request $request)
    {
        Log::info('Create order method called.');

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'province' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'commune' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'order_notes' => 'nullable|string',
        ]);

        Log::info('Validation passed.');

        $cart = Session::get('cart', []);
        $selectedProductIds = array_keys($cart);

        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'receiver_name' => $validatedData['name'],
                'receiver_phone' => $validatedData['phone'],
                'province' => $validatedData['province'],
                'district' => $validatedData['district'],
                'commune' => $validatedData['commune'],
                'village' => $validatedData['village'],
                'order_notes' => $validatedData['order_notes'],
            ]);

            Log::info('Order created with ID: ' . $order->id);

            foreach ($selectedProductIds as $productId) {
                $product = Product::findOrFail($productId);

                // Check if the stock is sufficient
                if ($product->stock < $cart[$productId]) {
                    throw new \Exception('Insufficient stock for product: ' . $product->name);
                }

                // Reduce the stock
                $product->stock -= $cart[$productId];
                $product->save();

                // Attach the product to the order
                $order->products()->attach($productId, ['quantity' => $cart[$productId]]);
            }

            Log::info('Products attached to order and stock updated.');

            Session::forget('cart');

            return redirect()->route('home')->with('success', 'Order created successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to create order: ' . $e->getMessage());
            return redirect()->route('orders.indexOrder')->with('error', 'Failed to create order: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
        ]);

        foreach ($request->products as $productId) {
            $product = Product::find($productId);
            if ($product) {
                $order->products()->attach($productId, ['quantity' => 1]);
            }
        }

        return redirect()->route('home')->with('success', 'Order created successfully.');
    }

    public function updateStatus(Order $order, Request $request)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('orders.index')->with('success', 'Order status updated successfully.');
    }

    public function status()
    {
        $orders = Order::where('user_id', Auth::id())->get(['id', 'status']);
        return response()->json($orders);
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('profile.show')->with('error', 'You are not authorized to cancel this order.');
        }

        if ($order->status === 'pending') {
            $order->update(['status' => 'cancelled']);
            return redirect()->route('profile.edit')->with('success', 'Order cancelled successfully.');
        }

        return redirect()->route('profile.edit')->with('error', 'Only pending orders can be cancelled.');
    }
}