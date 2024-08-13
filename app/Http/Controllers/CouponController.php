<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse; 


class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        $products = Product::all();
        return view('dashboard.coupons.index', compact('coupons', 'products'));
    }

    public function create()
    {
        return view('dashboard.coupons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons',
            'name' => 'required',
            'discount_amount' => 'required|numeric|min:0|max:100',
            'starts_at' => 'required|date',
            'expires_at' => 'required|date|after_or_equal:starts_at',
        ]);

        Coupon::create($request->all());

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
    }

    public function apply(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|exists:coupons,code',
            'product_id' => 'required|exists:products,id',
        ]);

        $coupon = Coupon::where('code', $request->input('coupon_code'))->first();
        $product = Product::find($request->input('product_id'));

        if ($coupon && $product) {
            $product->coupons()->attach($coupon);
        }

        return redirect('/dashboard/products/index')->with('success', 'Coupon applied successfully.');
    }
    public function destroy(string $id)
    {
        Coupon::destroy($id);
        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
    }
}