<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::withCount('products');

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('categoryName', 'LIKE', "%{$searchTerm}%");
        }

        $categories = $query->latest()->paginate(10);

        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'categoryName' => 'required|string|max:50',
            'categoryImg' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $category = new Category();
            $category->categoryName = $request->categoryName;

            if ($request->hasFile('categoryImg')) {
                $imagePath = $request->file('categoryImg')->store('categories', 'public');
                $category->categoryImg = $imagePath;
            }

            $category->save();

            return redirect()->route('categories.index')
                ->with('success', 'Category created successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating category: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::withCount('products')
            ->with(['products' => function($query) {
                $query->latest()->take(5);
            }])
            ->findOrFail($id);

        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        // Validate the request
        $validated = $request->validate([
            'categoryName' => 'required|string|max:50',
            'categoryImg' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $category->categoryName = $request->categoryName;

            // Handle image upload
            if ($request->hasFile('categoryImg')) {
                // Delete old image if exists
                if ($category->categoryImg && Storage::disk('public')->exists($category->categoryImg)) {
                    Storage::disk('public')->delete($category->categoryImg);
                }

                // Store new image
                $imagePath = $request->file('categoryImg')->store('categories', 'public');
                $category->categoryImg = $imagePath;
            }

            $category->save();

            return redirect()
                ->route('category.index')
                ->with('success', 'Category updated successfully');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error updating category: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::withCount('products')->findOrFail($id);

        // Check if category has associated products
        if ($category->products_count > 0) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'Cannot delete category with associated products.');
        }

        // Delete category image if exists
        if ($category->img) {
            Storage::disk('public')->delete($category->img);
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
