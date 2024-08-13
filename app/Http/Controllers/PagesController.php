<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;


class PagesController extends Controller
{
    public function productDetail($id) {
        $product = Product::with('ratings.user')->findOrFail($id);
        
        if (!$product) {
            abort(404); // Handle case where product is not found
        }
        
        $category = Category::all();

        // Fetch related products from the same category, excluding the current product
        $relatedProducts = Product::where('category_id', $product->category_id)
                                ->where('id', '!=', $id)
                                ->limit(4) // Limit the number of related products
                                ->get();

        return view('/pages/detailproductPage', [
            'product' => $product,
            'category' => $category,
            'relatedProducts' => $relatedProducts
        ]);
    }


    // shop folder
    public function shop() {
        $categories = Category::all();
        $categories = Category::with('subcategories')->get();        
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('pages.shops.shop',compact('products'), compact('categories'));
    }

    // Dog folder
    public function dogIndex() {
        $products = Product::whereHas('category', function($query) {
            $query->where('name', 'dog');
        })->get();

        return view('pages.dogs.allProduct', compact('products'));
    }

    public function dogFood()
    {
        // Fetch products where category is 'dog' and subcategory is 'food'
        $dogfoods = Product::whereHas('category', function($query) {
            $query->where('name', 'dog');
        })->whereHas('subcategory', function($query) {
            $query->where('name', 'food');
        })->get();

        return view('pages.dogs.foodPage', compact('dogfoods'));
    }
    public function dogToy()
    {
        // Fetch products where category is 'dog' and subcategory is 'food'
        $dogtoys = Product::whereHas('category', function($query) {
            $query->where('name', 'dog');
        })->whereHas('subcategory', function($query) {
            $query->where('name', 'toy');
        })->get();

        return view('pages.dogs.toyPage', compact('dogtoys'));
    }
    public function dogHealthcare()
    {
        // Fetch products where category is 'dog' and subcategory is 'food'
        $doghealthcares = Product::whereHas('category', function($query) {
            $query->where('name', 'dog');
        })->whereHas('subcategory', function($query) {
            $query->where('name', 'healthcare');
        })->get();

        return view('pages.dogs.healthcarePage', compact('doghealthcares'));
    }
    public function dogTreat()
    {
        // Fetch products where category is 'dog' and subcategory is 'food'
        $dogtreats = Product::whereHas('category', function($query) {
            $query->where('name', 'dog');
        })->whereHas('subcategory', function($query) {
            $query->where('name', 'treat');
        })->get();

        return view('pages.dogs.treatPage', compact('dogtreats'));
    }

    // cat section
    public function catIndex() {
        $products = Product::whereHas('category', function($query) {
            $query->where('name', 'cat');
        })->get();

        return view('pages.cats.allProduct', compact('products'));
    }
    public function catFood()
    {
        // Fetch products where category is 'cat' and subcategory is 'food'
        $catfoods = Product::whereHas('category', function($query) {
            $query->where('name', 'cat');
        })->whereHas('subcategory', function($query) {
            $query->where('name', 'food');
        })->get();

        return view('pages.cats.foodPage', compact('catfoods'));
    }
    public function catToy()
    {
        // Fetch products where category is 'cat' and subcategory is 'food'
        $cattoys = Product::whereHas('category', function($query) {
            $query->where('name', 'cat');
        })->whereHas('subcategory', function($query) {
            $query->where('name', 'toy');
        })->get();

        return view('pages.cats.toyPage', compact('cattoys'));
    }
    public function catHealthcare()
    {
        // Fetch products where category is 'cat' and subcategory is 'food'
        $cathealthcares = Product::whereHas('category', function($query) {
            $query->where('name', 'cat');
        })->whereHas('subcategory', function($query) {
            $query->where('name', 'healthcare');
        })->get();

        return view('pages.cats.healthcarePage', compact('cathealthcares'));
    }
    public function catTreat()
    {
        // Fetch products where category is 'cat' and subcategory is 'food'
        $cattreats = Product::whereHas('category', function($query) {
            $query->where('name', 'cat');
        })->whereHas('subcategory', function($query) {
            $query->where('name', 'treat');
        })->get();

        return view('pages.cats.treatPage', compact('cattreats'));
    }

}
