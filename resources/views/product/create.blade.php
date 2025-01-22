@extends('layouts.dashboardmaster')

@section('content')



    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="text-center mb-0">Product Details</h5>
                </div>
                <div class="card-body">
                    <form action="your_server_endpoint" method="POST" enctype="multipart/form-data">
                        <!-- Product Name and Brand -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="product_name">Product Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="brand">Brand</label>
                                <select class="form-control" id="brand" name="brand" required>
                                    <option value="">Select Brand</option>
                                    <option value="brand1">Brand 1</option>
                                    <option value="brand2">Brand 2</option>
                                </select>
                            </div>
                        </div>

                        <!-- Category and Price -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="category1">Category 1</option>
                                    <option value="category2">Category 2</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                                </div>
                            </div>
                        </div>

                        <!-- Stock and Discount -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="stock">Stock</label>
                                <input type="number" class="form-control" id="stock" name="stock" required>
                            </div>
                            <div class="col-md-6">
                                <label for="discount">Discount (%)</label>
                                <input type="number" class="form-control" id="discount" name="discount" required>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" required></textarea>
                        </div>

                        <!-- Drag and Drop File Upload -->
                        <div class="drop-zone" id="drop-zone">
                            <p>Drag & Drop Product Image Here or Click to Select</p>
                            <input type="file" name="product_image" id="product_image" class="d-none" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple onchange="handleFileSelect(event)">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">+ Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>





@endsection
