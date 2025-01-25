@extends('layouts.dashboardmaster')
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Products List</h5>
                    <a href="{{ route('products.create') }}" class="btn btn-light">Add New Product</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Search Form -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <form action="{{ route('products.index') }}" method="GET" class="d-flex gap-2">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                           placeholder="Search by title, price, category, or brand..."
                                           value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="bx bx-search"></i> Search
                                    </button>
                                    @if(request('search'))
                                        <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                            <i class="bx bx-x"></i> Clear
                                        </a>
                                    @endif
                                </div>
                                <select name="category" class="form-select" style="width: auto;">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->categoryName }}
                                        </option>
                                    @endforeach
                                </select>
                                <select name="brand" class="form-select" style="width: auto;">
                                    <option value="">All Brands</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ request('brand') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <select name="remark" class="form-select" style="width: auto;">
                                    <option value="">All Remarks</option>
                                    @foreach(['popular', 'new', 'top', 'special', 'trending', 'regular'] as $remark)
                                        <option value="{{ $remark }}"
                                            {{ request('remark') == $remark ? 'selected' : '' }}>
                                            {{ ucfirst($remark) }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-0" id="productTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Rating</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $key => $product)
                                    <tr>
                                        <td>{{ $products->firstItem() + $key }}</td>
                                        <td>
                                            <img src="{{ asset('storage/'.$product->image) }}"
                                                alt="{{ $product->title }}"
                                                class="img-thumbnail"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        </td>
                                        <td>
                                            {{ $product->title }}
                                            <div class="small text-muted">{{ Str::limit($product->short_des, 50) }}</div>
                                        </td>
                                        <td>${{ $product->price }}</td>
                                        <td>
                                            @if($product->discount)
                                                <span class="badge bg-success">Yes - ${{ $product->discount_price }}</span>
                                            @else
                                                <span class="badge bg-secondary">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->stock)
                                                <span class="badge bg-success">In Stock</span>
                                            @else
                                                <span class="badge bg-danger">Out of Stock</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="text-warning">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $product->star)
                                                        <i class="bx bxs-star"></i>
                                                    @else
                                                        <i class="bx bx-star"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $product->remark }}</span>
                                        </td>
                                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                                        <td>{{ $product->brand->name ?? 'N/A' }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('products.show', $product->id) }}"
                                                   class="btn btn-info btn-sm">
                                                    <i class="bx bx-show"></i>
                                                </a>
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                   class="btn btn-warning btn-sm">
                                                    <i class="bx bx-edit"></i>
                                                </a>
                                                <form action="{{ route('products.destroy', $product->id) }}"
                                                      method="POST"
                                                      class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this product?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">No products found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable with search disabled (we're using our custom search)
        $('#productTable').DataTable({
            "pageLength": 10,
            "ordering": true,
            "info": true,
            "responsive": true,
            "dom": 'rt<"bottom"lip><"clear">',
            "searching": false // Disable DataTables search
        });

        // Auto-submit form when select fields change
        $('select[name="category"], select[name="brand"], select[name="remark"]').change(function() {
            $(this).closest('form').submit();
        });
    });
</script>
@endpush
@endsection
