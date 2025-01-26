@extends('layouts.dashboardmaster')
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Brand Details</h5>
                    <div>
                        <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-warning btn-sm">
                            <i class="bx bx-edit"></i> Edit
                        </a>
                        <a href="{{ route('brands.index') }}" class="btn btn-light btn-sm">
                            <i class="bx bx-arrow-back"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Brand Image -->
                        <div class="col-md-4 text-center mb-4">
                            @if($brand->brandImg)
                                <img src="{{ asset("storage/{$brand->brandImg}") }}"
                                     alt="{{ $brand->brandName }}"
                                     class="img-fluid rounded shadow-sm"
                                     style="max-height: 200px; object-fit: cover;">
                            @else
                                <div class="border rounded p-4">
                                    <i class="bx bx-image text-muted" style="font-size: 100px;"></i>
                                    <p class="text-muted">No image available</p>
                                </div>
                            @endif
                        </div>

                        <!-- Brand Information -->
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th style="width: 200px;">Brand Name</th>
                                            <td>{{ $brand->brandName }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Products</th>
                                            <td>{{ $brand->products_count }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td>{{ $brand->created_at->format('F d, Y h:i A') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Last Updated</th>
                                            <td>{{ $brand->updated_at->format('F d, Y h:i A') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Products in this Brand -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5 class="mb-3">Products in this Brand</h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>Remark</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($brand->products as $product)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset("storage/{$product->image}") }}"
                                                         alt="{{ $product->title }}"
                                                         class="img-thumbnail"
                                                         style="height: 50px; width: 50px; object-fit: cover;">
                                                </td>
                                                <td>
                                                    {{ $product->title }}
                                                    <div class="small text-muted">{{ Str::limit($product->short_des, 50) }}</div>
                                                </td>
                                                <td>
                                                    ${{ $product->price }}
                                                    @if($product->discount)
                                                        <div class="small text-success">
                                                            Discount: ${{ $product->discount_price }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($product->stock)
                                                        <span class="badge bg-success">In Stock</span>
                                                    @else
                                                        <span class="badge bg-danger">Out of Stock</span>
                                                    @endif
                                                </td>
                                                <td>{{ $product->category->categoryName }}</td>
                                                <td>{{ $product->brand->brandName }}</td>
                                                <td>
                                                    <span class="badge bg-info">{{ ucfirst($product->remark) }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('products.show', $product->id) }}"
                                                       class="btn btn-info btn-sm">
                                                        <i class="bx bx-show"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No products found in this brands.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
