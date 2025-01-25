@extends('layouts.dashboardmaster')
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Brands List</h5>
                    <div class="d-flex gap-2">
                        <form action="{{ route('brands.index') }}" method="GET" class="d-flex gap-2">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control"
                                       placeholder="Search brands..."
                                       value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                @if(request('search'))
                                    <a href="{{ route('brands.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </div>
                        </form>
                        <a href="{{ route('brands.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> New Brand
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-0" id="brandTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Products Count</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($brands as $key => $brand)
                                    <tr>
                                        <td>{{ $brands->firstItem() + $key }}</td>
                                        <td>
                                            @if($brand->brandImg)
                                                <img src="{{ asset('storage/brands/' . basename($brand->brandImg)) }}"
                                                     alt="{{ $brand->brandName }}"
                                                     class="img-thumbnail"
                                                     style="height: 50px; width: 50px; object-fit: cover;">
                                            @else
                                                <span class="text-muted">No image</span>
                                            @endif
                                        </td>
                                        <td>{{ $brand->brandName }}</td>
                                        <td>
                                            <span class="badge bg-info">
                                                {{ $brand->products_count }}
                                            </span>
                                        </td>
                                        <td>{{ $brand->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('brands.show', $brand->id) }}"
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('brands.edit', $brand->id) }}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('brands.destroy', $brand->id) }}"
                                                      method="POST"
                                                      class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this brand?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No brands found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        @if(request('search'))
                            {{ $brands->appends(['search' => request('search')])->links() }}
                        @else
                            {{ $brands->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#brandTable').DataTable({
            "pageLength": 10,
            "ordering": true,
            "info": true,
            "responsive": true,
            "dom": 'rt<"bottom"lip><"clear">',
            "searching": false // Disable DataTables search since we have custom search
        });
    });
</script>
@endpush
@endsection
