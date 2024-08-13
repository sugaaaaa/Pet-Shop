<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Coupon;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {       
        $products = Product::all(); 
        $categories = Category::all();
        $categories = Category::with('subcategories')->get();        
        $products = Product::orderBy('created_at', 'desc')->get();
        $coupons = Coupon::all();
        return view('pages.homePage',compact('products'), compact('categories', 'coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}