@extends('layouts.dashboardmaster')
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="text-center mb-0">Create New Brand</h5>
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

                    <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Brand Name -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="brandName" class="form-label">Brand Name</label>
                                <input type="text"
                                       class="form-control @error('brandName') is-invalid @enderror"
                                       id="brandName"
                                       name="brandName"
                                       value="{{ old('brandName') }}"
                                       maxlength="200"
                                       required>
                                @error('brandName')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Brand Image -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="brandImg" class="form-label">Brand Image</label>
                                <input type="file"
                                       class="form-control @error('brandImg') is-invalid @enderror"
                                       id="brandImg"
                                       name="brandImg"
                                       accept="image/*">
                                @error('brandImg')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="imagePreview" class="mt-2"></div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-save"></i> Create Brand
                                </button>
                                <a href="{{ route('brands.index') }}" class="btn btn-secondary">
                                    <i class="bx bx-x"></i> Cancel
                                </a>
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
    document.getElementById('brandImg').addEventListener('change', function(event) {
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
