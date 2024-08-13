<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Notifications\ProductLowStock;
use Illuminate\Support\Facades\Notification;

class ProductController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        
        $products = Product::with('coupons')->get();
        
        foreach ($products as $product) {
            $product->lowStock = $product->isNearlyOutOfStock();
        }

        return view('dashboard.products.index', compact('products', 'categories' ,'subcategories'));
    }

    public function create(): View
    {
        $categories = Category::all();
        $subcategories = SubCategory::all(); 
        return view('dashboard.products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
            $nameImage = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $nameImage);

            $category = Category::firstOrCreate(['name' => $request->input('category_name')]);
            $sub_category = SubCategory::firstOrCreate(['name' => $request->input('sub_category_name')]);

            $price = $this->calculatePrice($request->input('weight'));

            $product = new Product([
                'name' => $request->input('name'),
                'price' => $price,
                'detail' => $request->input('detail'),
                'stock' => $request->input('stock'),
                'weight' => $request->input('weight'),
                'images' => $nameImage,
                'category_id' => $category->id,
                'sub_category_id' => $sub_category->id,
            ]);
            $product->save();

            return redirect('/dashboard/products/index')->with('success', 'Product created successfully.');
    }

    public function show(string $id): View
    {
        $products = Product::find($id);
        $categories = Category::all();
        $subcategories = SubCategory::all(); 
        return view('dashboard.products.update', compact('products', 'categories', 'subcategories'));
    }

    public function edit(string $id): View
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $subcategories = SubCategory::all(); 
        return view('dashboard.products.update', compact('product', 'categories', 'subcategories'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        $product->name = $request->input('name');
        $product->detail = $request->input('detail');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->weight = $request->input('weight');
        $product->price = $this->calculatePrice($product->weight);

        if ($request->hasFile('image')) {
            $nameImage = time() . '.' . $request->image->extension();
            $request->image->move(public_path('/images'), $nameImage);
            $product->images = $nameImage;
        }

        $category = Category::firstOrCreate(['name' => $request->input('category_name')]);
        $product->category_id = $category->id;


        $sub_category = SubCategory::firstOrCreate(
            ['name' => $request->input('sub_category_name')],
            ['category_id' => $category->id]
        );
        $product->sub_category_id = $sub_category->id;

        // dd($request->all());

        $product->save();

        return redirect('/dashboard/products/index')->with('success', 'Product updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        Product::destroy($id);
        return redirect('dashboard/products/index')->with('success', 'Product deleted successfully.');
    }

    private function calculatePrice(float $weight): float
    {
        return $weight * 10;
    }
    
    public function checkStock(Product $product)
    {
        if ($product->isNearlyOutOfStock()) {
            Notification::route('mail', 'admin@example.com')->notify(new ProductLowStock($product));

            return view('products.show', ['product' => $product, 'lowStock' => true]);
        }

        return view('products.show', ['product' => $product, 'lowStock' => false]);
    }
    
    public function rate(Request $request)
    {
        $productId = $request->input('product_id');
        $rating = $request->input('rating');

        return redirect()->back()->with('success', 'Rating submitted successfully');
    }
    
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search products based on the query
        $products = Product::where('name', 'LIKE', "%{$query}%")
        ->orWhere('detail', 'LIKE', "%{$query}%")
        ->get();

        // Return the search results to the view
        return view('pages.homePage', ['products' => $products, 'search' => true]);
    }

}