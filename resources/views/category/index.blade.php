@extends('layouts.dashboardmaster')

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header bg-white py-3">
            <div class="row g-3 align-items-center">
                <div class="col-12 col-sm-6 col-lg-4">
                    <h5 class="mb-0">Categories</h5>
                </div>
                <div class="col-12 col-sm-6 col-lg-8">
                    <div class="d-flex gap-2 justify-content-sm-end">
                        <!-- Search Form -->
                        <form action="{{ route('categories.index') }}" method="GET" class="d-flex gap-2">
                            <div class="input-group">
                                <input type="text"
                                       class="form-control"
                                       placeholder="Search categories..."
                                       name="search"
                                       value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                @if(request('search'))
                                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </div>
                        </form>

                        <!-- Create New Category Button -->
                        <a href="{{ route('categories.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered mb-0" id="categoryTable">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Products Count</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $key => $category)
                            <tr>
                                <td>{{ $categories->firstItem() + $key }}</td>
                                <td>
                                    @if($category->categoryImg)
                                        <img src="{{ asset('storage/' . $category->categoryImg) }}"
                                             alt="{{ $category->categoryName }}"
                                             class="img-thumbnail"
                                             style="height: 50px; width: 50px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>{{ $category->categoryName }}</td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ $category->products_count }}
                                    </span>
                                </td>
                                <td>{{ $category->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('categories.show', $category->id) }}"
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if($category->products_count == 0)
                                            <form action="{{ route('categories.destroy', $category->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#categoryTable').DataTable({
            "pageLength": 10,
            "ordering": true,
            "info": true,
            "responsive": true,
            "dom": 'rt<"bottom"lip><"clear">',
            "searching": false // Disable DataTables search since we have custom search
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });
</script>
@endpush
@endsection
