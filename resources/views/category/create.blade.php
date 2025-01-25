@extends('layouts.dashboardmaster')
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="text-center mb-0">Create New Category</h5>
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

                    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Category Name -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="categoryName" class="form-label">Category Name</label>
                                <input type="text"
                                       class="form-control @error('categoryName') is-invalid @enderror"
                                       id="categoryName"
                                       name="categoryName"
                                       value="{{ old('categoryName') }}"
                                       maxlength="50"
                                       required>
                                @error('categoryName')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Category Image -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="categoryImg" class="form-label">Category Image</label>
                                <input type="file"
                                       class="form-control @error('categoryImg') is-invalid @enderror"
                                       id="categoryImg"
                                       name="categoryImg"
                                       accept="image/*"
                                       required>
                                @error('categoryImg')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    Create Category
                                </button>
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
    // Image preview functionality
    document.getElementById('img').addEventListener('change', function(event) {
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.innerHTML = '';

        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail');
                img.style.maxHeight = '200px';
                imagePreview.appendChild(img);
            }

            reader.readAsDataURL(event.target.files[0]);
        }
    });
</script>
@endpush
@endsection
