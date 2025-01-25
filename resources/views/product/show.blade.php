@extends('layouts.dashboardmaster')
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Product Details</h5>
                    <div>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                            <i class="bx bx-edit"></i> Edit
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-light btn-sm">
                            <i class="bx bx-arrow-back"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Product Image -->
                        <div class="col-md-4 text-center mb-4">
                            <img src="{{ asset('storage/'.$product->image) }}"
                                 alt="{{ $product->title }}"
                                 class="img-fluid rounded shadow-sm"
                                 style="max-height: 300px; object-fit: cover;">
                        </div>

                        <!-- Product Information -->
                        <div class="col-md-8">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th style="width: 200px;">Title</th>
                                            <td>{{ $product->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>{{ $product->short_des }}</td>
                                        </tr>
                                        <tr>
                                            <th>Price</th>
                                            <td>${{ $product->price }}</td>
                                        </tr>
                                        <tr>
                                            <th>Discount Status</th>
                                            <td>
                                                @if($product->discount)
                                                    <span class="badge bg-success">Active</span>
                                                    <span class="ms-2">Discount Price: ${{ $product->discount_price }}</span>
                                                @else
                                                    <span class="badge bg-secondary">Not Active</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Stock Status</th>
                                            <td>
                                                @if($product->stock)
                                                    <span class="badge bg-success">In Stock</span>
                                                @else
                                                    <span class="badge bg-danger">Out of Stock</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Rating</th>
                                            <td>
                                                <div class="text-warning">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $product->star)
                                                            <i class="bx bxs-star"></i>
                                                        @else
                                                            <i class="bx bx-star"></i>
                                                        @endif
                                                    @endfor
                                                    <span class="text-dark ms-2">({{ $product->star }} / 5)</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Remark</th>
                                            <td>
                                                <span class="badge bg-info">{{ ucfirst($product->remark) }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Category</th>
                                            <td>{{ $product->category->categoryName ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Brand</th>
                                            <td>{{ $product->brand->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td>{{ $product->created_at->format('F d, Y h:i A') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Last Updated</th>
                                            <td>{{ $product->updated_at->format('F d, Y h:i A') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-4">
                                <form action="{{ route('products.destroy', $product->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bx bx-trash"></i> Delete Product
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
