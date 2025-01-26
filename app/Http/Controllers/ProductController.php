<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand']);

        // Search functionality
        if ($request->filled('search')) {
            $search = trim($request->search);
            $searchLike = "{$search}%";

            $query->where(function($q) use ($search, $searchLike) {
                $q->where('id', 'LIKE', $search)  // Search by ID (exact match)
                  ->orWhereRaw('LOWER(title) LIKE ?', ["%".strtolower($search)."%"])
                  ->orWhere('price', 'LIKE', "%{$search}%")
                  ->orWhereHas('category', function($q) use ($search) {
                      $q->whereRaw('LOWER(categoryName) LIKE ?', ["%".strtolower($search)."%"]);
                  })
                  ->orWhereHas('brand', function($q) use ($search) {
                      $q->whereRaw('LOWER(brandName) LIKE ?', ["%".strtolower($search)."%"]);
                  });
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by brand
        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }

        // Filter by remark
        if ($request->filled('remark')) {
            $query->where('remark', $request->remark);
        }

        $categories = Category::all();
        $brands = Brand::all();
        $products = $query->paginate(10);

        return view('product.index', compact('products', 'categories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'short_des' => 'required|string|max:500',
            'price' => 'required|string|max:50',
            'discount' => 'required|boolean',
            'discount_price' => 'required_if:discount,1|string|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|boolean',
            'star' => 'nullable|numeric|between:0,5',
            'remark' => 'required|in:popular,new,top,special,trending,regular',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with(['category', 'brand', 'productDetails'])
            ->findOrFail($id);
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        return view('product.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'short_des' => 'required|string|max:500',
            'price' => 'required|string|max:50',
            'discount' => 'required|boolean',
            'discount_price' => 'required_if:discount,1|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|boolean',
            'star' => 'nullable|numeric|between:0,5',
            'remark' => 'required|in:popular,new,top,special,trending,regular',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Delete the product image from storage
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
