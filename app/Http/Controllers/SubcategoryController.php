<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::with('category')->get();
        $categories = Category::all();
        return view('dashboard.subcategory.index', compact('subcategories', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.subcategory.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:category,id',
        ]);

        SubCategory::create($request->all());

        return redirect('/dashboard/subcategory/index')->with('success', 'SubCategory created successfully.');
    }

    public function show($id)
    {
        $categories = Category::all();
        $subcategories = SubCategory::find($id);
        return view('dashboard.subcategory.show', compact('subcategories', 'categories'));
    }

    public function edit($id)
    {
        $categories = Category::all();
        $subcategories = SubCategory::find($id);
        return view('dashboard.subcategory.edit', compact('subcategories', 'categories'));
    }

    public function update(Request $request, SubCategory $subcategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subcategory->update($request->all());

        return redirect('dashboard.subcategory.index')->with('success', 'SubCategory updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        SubCategory::destroy($id);

        return redirect('/dashboard/subcategory/index')->with('success', 'SubCategory deleted successfully.');
    }
}