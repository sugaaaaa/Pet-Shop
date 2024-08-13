<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;


class WishlistController extends Controller
{
    use ValidatesRequests;

    public function index()
    {
        $wishlists = Wishlist::with('product')->get();
        return view('pages.favoritePage', ['wishlists' => $wishlists]);
    }

    public function addWishlist(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
        ]);

        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'You must be logged in to add items to your wishlist.']);
        }

        $user_id = auth()->user()->id;
        $product_id = $request->product_id;

        $isAlreadyAdded = Wishlist::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();

        if ($isAlreadyAdded) {
            return response()->json(['success' => false, 'message' => 'Product already added to favorites']);
        }

        $wishlist = new Wishlist();
        $wishlist->product_id = $product_id;
        $wishlist->user_id = $user_id;
        $wishlist->save();

        return response()->json(['success' => true, 'message' => 'Product successfully added to favorites']);
    }

    public function remove(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'required',
        ]);

        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'You must be logged in to remove items from your wishlist.']);
        }

        $user_id = auth()->user()->id;
        $product_id = $request->product_id;

        Log::info('Remove request received', ['user_id' => $user_id, 'product_id' => $product_id]);

        $wishlist = Wishlist::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();

        if (!$wishlist) {
            Log::warning('Wishlist item not found', ['user_id' => $user_id, 'product_id' => $product_id]);
            return response()->json(['success' => false, 'message' => 'Wishlist item not found']);
        }

        $wishlist->delete();
        Log::info('Wishlist item removed', ['user_id' => $user_id, 'product_id' => $product_id]);

        return response()->json(['success' => true, 'message' => 'Item removed from favorites']);
    }
}