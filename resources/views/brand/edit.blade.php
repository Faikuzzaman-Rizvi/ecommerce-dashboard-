@extends('layouts.dashboardmaster')
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="text-center mb-0">Edit Brand</h5>
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

                    <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Brand Name -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Brand Name</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $brand->name) }}"
                                       maxlength="200"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Brand Image -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="img" class="form-label">Brand Image</label>
                                <input type="file"
                                       class="form-control @error('img') is-invalid @enderror"
                                       id="img"
                                       name="img"
                                       accept="image/*">
                                @error('img')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <!-- Current Image Preview -->
                                <div id="imagePreview" class="mt-2">
                                    @if($brand->img)
                                        <div class="current-image mb-2">
                                            <p class="text-muted mb-1">Current Image:</p>
                                            <img src="{{ asset('storage/' . $brand->img) }}"
                                                 alt="Current Brand Image"
                                                 class="img-thumbnail"
                                                 style="max-height: 200px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-save"></i> Update Brand
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
    document.getElementById('img').addEventListener('change', function(event) {
        const imagePreview = document.getElementById('imagePreview');
        const currentImage = imagePreview.querySelector('.current-image');

        // Remove new image preview if exists
        const newPreview = imagePreview.querySelector('.new-image');
        if (newPreview) {
            newPreview.remove();
        }

        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const newImageDiv = document.createElement('div');
                newImageDiv.classList.add('new-image', 'mb-2');

                const label = document.createElement('p');
                label.classList.add('text-muted', 'mb-1');
                label.textContent = 'New Image:';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail');
                img.style.maxHeight = '200px';

                newImageDiv.appendChild(label);
                newImageDiv.appendChild(img);

                if (currentImage) {
                    imagePreview.insertBefore(newImageDiv, currentImage);
                } else {
                    imagePreview.appendChild(newImageDiv);
                }
            }

            reader.readAsDataURL(event.target.files[0]);
        }
    });
</script>
@endpush
@endsection
