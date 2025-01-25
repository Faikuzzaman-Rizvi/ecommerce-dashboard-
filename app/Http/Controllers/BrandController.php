<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Brand::withCount('products');

        // Search functionality
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('brandName', 'LIKE', "%{$searchTerm}%");
        }

        $brands = $query->latest()->paginate(10);
        return view('brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brandName' => 'required|string|max:200',
            'brandImg' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $brand = new Brand();
        $brand->brandName = $request->brandName;

        // Handle image upload if present
        if ($request->hasFile('brandImg')) {
            // Store in the brands subdirectory
            $imagePath = $request->file('brandImg')->store('brands', 'public');
            $brand->brandImg = $imagePath; // This will store path like 'brands/filename.jpg'
        }

        $brand->save();

        return redirect()->route('brands.index')
            ->with('success', 'Brand created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = Brand::withCount('products')
            ->with(['products' => function($query) {
                $query->with('category')
                    ->latest();
            }])
            ->findOrFail($id);

        return view('brand.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::findOrFail($id);
        return view('brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:200|unique:brands,name,' . $id,
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('img')) {
            // Delete old image if exists
            if ($brand->img) {
                Storage::disk('public')->delete($brand->img);
            }

            $imagePath = $request->file('img')->store('brands', 'public');
            $validated['img'] = $imagePath;
        }

        $brand->update($validated);

        return redirect()
            ->route('brand.index')
            ->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::withCount('products')->findOrFail($id);

        // Check if brand has associated products
        if ($brand->products_count > 0) {
            return redirect()
                ->route('brand.index')
                ->with('error', 'Cannot delete brand with associated products.');
        }

        // Delete brand image if exists
        if ($brand->img) {
            Storage::disk('public')->delete($brand->img);
        }

        $brand->delete();

        return redirect()
            ->route('brand.index')
            ->with('success', 'Brand deleted successfully.');
    }
}
