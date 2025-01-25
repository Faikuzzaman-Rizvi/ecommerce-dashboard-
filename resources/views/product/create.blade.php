@extends('layouts.dashboardmaster')

@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="text-center mb-0">Create New Product</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Title and Short Description -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="title" class="form-label">Product Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                       id="title" name="title" value="{{ old('title') }}"
                                       maxlength="200" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="short_des" class="form-label">Short Description</label>
                                <textarea class="form-control @error('short_des') is-invalid @enderror"
                                          id="short_des" name="short_des"
                                          maxlength="500" required>{{ old('short_des') }}</textarea>
                                @error('short_des')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Price and Discount -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror"
                                       id="price" name="price" value="{{ old('price') }}"
                                       maxlength="50" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="discount" class="form-label">Discount</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                           id="discount" name="discount" value="1"
                                           {{ old('discount') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="discount">Enable Discount</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="discount_price" class="form-label">Discount Price</label>
                                <input type="text" class="form-control @error('discount_price') is-invalid @enderror"
                                       id="discount_price" name="discount_price"
                                       value="{{ old('discount_price') }}" maxlength="50">
                                @error('discount_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Stock and Star Rating -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="stock" class="form-label">Stock Status</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                           id="stock" name="stock" value="1"
                                           {{ old('stock', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="stock">In Stock</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="star" class="form-label">Star Rating</label>
                                <input type="number" class="form-control @error('star') is-invalid @enderror"
                                       id="star" name="star" value="{{ old('star', 0) }}"
                                       min="0" max="5" step="0.1">
                                @error('star')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Category and Brand -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select @error('category_id') is-invalid @enderror"
                                        id="category_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->categoryName }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="brand_id" class="form-label">Brand</label>
                                <select class="form-select @error('brand_id') is-invalid @enderror"
                                        id="brand_id" name="brand_id" required>
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Remark -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="remark" class="form-label">Remark</label>
                                <select class="form-select @error('remark') is-invalid @enderror"
                                        id="remark" name="remark" required>
                                    <option value="">Select Remark</option>
                                    @foreach(['popular', 'new', 'top', 'special', 'trending', 'regular'] as $remark)
                                        <option value="{{ $remark }}"
                                            {{ old('remark') == $remark ? 'selected' : '' }}>
                                            {{ ucfirst($remark) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('remark')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="image" class="form-label">Product Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                       id="image" name="image" accept="image/*" required>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Create Product</button>
                                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Toggle discount price field based on discount checkbox
    document.getElementById('discount').addEventListener('change', function() {
        const discountPriceField = document.getElementById('discount_price');
        discountPriceField.required = this.checked;
        discountPriceField.disabled = !this.checked;
        if (!this.checked) {
            discountPriceField.value = '';
        }
    });

    // Initialize the discount price field state
    document.addEventListener('DOMContentLoaded', function() {
        const discountCheckbox = document.getElementById('discount');
        const discountPriceField = document.getElementById('discount_price');
        discountPriceField.required = discountCheckbox.checked;
        discountPriceField.disabled = !discountCheckbox.checked;
    });
</script>
@endpush
@endsection
