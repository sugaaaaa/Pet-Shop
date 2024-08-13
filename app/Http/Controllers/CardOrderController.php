<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CardOrderController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $cartProducts = Product::whereIn('id', array_keys($cart))->get();

        $subtotal = 0;
        foreach ($cartProducts as $product) {
            $subtotal += $product->price * $cart[$product->id];
        }

        $recommendedProducts = Product::whereNotIn('id', array_keys($cart))
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('pages.viewCartProduct', [
            'cartProducts' => $cartProducts,
            'cart' => $cart,
            'subtotal' => $subtotal,
            'products' => $recommendedProducts,
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $productId = $request->input('product_id');
        $product = Product::find($productId);
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            if ($cart[$productId] < $product->stock) {
                $cart[$productId]++;
            } else {
                return response()->json(['success' => false, 'message' => 'Cannot add more than available stock.']);
            }
        } else {
            if ($product->stock > 0) {
                $cart[$productId] = 1;
            } else {
                return response()->json(['success' => false, 'message' => 'Product is out of stock.']);
            }
        }

        Session::put('cart', $cart);

        return response()->json(['success' => true]);
    }

    public function createOrder(Request $request)
    {
        $cart = Session::get('cart', []);
        $selectedProducts = Product::whereIn('id', array_keys($cart))->get();

        return view('pages.orderPage', compact('selectedProducts', 'cart'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'selected_products' => 'required|array',
            'selected_products.*' => 'exists:products,id',
        ]);

        $selected_products = $request->selected_products;
        $cart = Session::get('cart', []);

        foreach ($selected_products as $product_id) {
            $product = Product::find($product_id);
            if (isset($cart[$product_id])) {
                if ($cart[$product_id] < $product->stock) {
                    $cart[$product_id]++;
                } else {
                    return redirect()->route('pages.viewCartProduct')->with('error', 'Cannot add more than available stock.');
                }
            } else {
                if ($product->stock > 0) {
                    $cart[$product_id] = 1;
                } else {
                    return redirect()->route('pages.viewCartProduct')->with('error', 'Product is out of stock.');
                }
            }
        }

        Session::put('cart', $cart);

        return redirect()->route('pages.viewCartProduct')->with('success', 'Products added to cart successfully.');
    }

    public function updateCart(Request $request)
    {
        $quantities = $request->input('quantities');
        $cart = Session::get('cart', []);
        $cartProducts = Product::whereIn('id', array_keys($cart))->get();

        foreach ($quantities as $productId => $quantity) {
            $product = $cartProducts->where('id', $productId)->first();
            if ($product && $quantity <= $product->stock) {
                $cart[$productId] = $quantity;
            } else {
                return redirect()->route('pages.viewCartProduct')->with('error', 'Cannot exceed stock limit for ' . $product->name);
            }
        }

        Session::put('cart', $cart);

        return redirect()->route('pages.viewCartProduct')->with('success', 'Cart updated successfully.');
    }
    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        $productId = $request->input('product_id');

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            return redirect()->route('pages.viewCartProduct')->with('success', 'Product removed from cart.');
        }

        return redirect()->route('pages.viewCartProduct')->with('error', 'Product not found in cart.');
    }

}