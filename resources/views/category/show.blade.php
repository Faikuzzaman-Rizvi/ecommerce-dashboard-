@extends('layouts.dashboardmaster')
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Category Details</h5>
                    <div>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">
                            <i class="bx bx-edit"></i> Edit
                        </a>
                        <a href="{{ route('categories.index') }}" class="btn btn-light btn-sm">
                            <i class="bx bx-arrow-back"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Category Image -->
                        <div class="col-md-4">
                            @if($category->categoryImg)
                                <img src="{{ asset('storage/' . $category->categoryImg) }}"
                                     alt="{{ $category->categoryName }}"
                                     class="img-fluid rounded">
                            @else
                                <div class="text-center p-4 bg-light">
                                    <span class="text-muted">No image available</span>
                                </div>
                            @endif
                        </div>

                        <!-- Category Information -->
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th style="width: 200px;">Category Name</th>
                                            <td>{{ $category->categoryName }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Products</th>
                                            <td>{{ $category->products_count }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td>{{ $category->created_at->format('F d, Y h:i A') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Last Updated</th>
                                            <td>{{ $category->updated_at->format('F d, Y h:i A') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Products List -->
                    @if($category->products->count() > 0)
                        <div class="mt-4">
                            <h4>Products in this Category</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($category->products as $product)
                                            <tr>
                                                <td>
                                                    @if($product->image)
                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                             alt="{{ $product->title }}"
                                                             class="img-thumbnail"
                                                             style="height: 50px; width: 50px; object-fit: cover;">
                                                    @endif
                                                </td>
                                                <td>{{ $product->title }}</td>
                                                <td>${{ $product->price }}</td>
                                                <td>
                                                    @if($product->stock)
                                                        <span class="badge bg-success">In Stock</span>
                                                    @else
                                                        <span class="badge bg-danger">Out of Stock</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
