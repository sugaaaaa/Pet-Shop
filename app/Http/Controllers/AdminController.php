<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Rating;
use App\Models\ReviewRating;
use App\Notifications\OrderStatusNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', 'pending')->with('products')->get();
        return view('dashboard.orders.index', compact('orders'));
    }

    public function approve(Order $order)
    {
        $order->update(['status' => 'approved']);
        Log::info('Order approved: ' . $order->id);

        // Notify user (optional)
        $this->notifyUser($order, 'approved');

        return redirect()->route('dashboard.orders.index')->with('success', 'Order approved successfully!');
    }

    public function reject(Order $order)
    {
        $order->update(['status' => 'rejected']);
        Log::info('Order rejected: ' . $order->id);

        // Notify user (optional)
        $this->notifyUser($order, 'rejected');

        return redirect()->route('dashboard.orders.index')->with('success', 'Order rejected successfully!');
    }

    public function changeProductStatus(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->status = $request->input('status');
        $product->save();

        return redirect()->back()->with('success', 'Product status updated successfully.');
    }

    public function changeOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    protected function notifyUser(Order $order, $status)
    {
        $user = $order->user;
        $message = "Your order #{$order->id} has been {$status}.";
        $user->notify(new OrderStatusNotification($message));
    }

    public function showRatings()
    {
        $ratings = Rating::with('user', 'product')->where('approved', false)->get();
        return view('admin.ratings', compact('ratings'));
    }

    public function approveRating($id)
    {
        $rating = Rating::find($id);
        if ($rating) {
            $rating->approved = true;
            $rating->save();
        }

        return redirect()->route('admin.ratings')->with('success', 'Rating approved successfully');
    }
}