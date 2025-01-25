@extends('layouts.dashboardmaster')
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="text-center mb-0">Edit Category</h5>
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

                    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Category Name -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="categoryName" class="form-label">Category Name</label>
                                <input type="text"
                                       class="form-control @error('categoryName') is-invalid @enderror"
                                       id="categoryName"
                                       name="categoryName"
                                       value="{{ old('categoryName', $category->categoryName) }}"
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
                                       accept="image/*">
                                @error('categoryImg')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($category->categoryImg)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $category->categoryImg) }}"
                                             alt="Current Category Image"
                                             class="img-thumbnail"
                                             style="height: 100px;">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-save"></i> Update Category
                                </button>
                                <a href="{{ route('categories.index') }}" class="btn btn-secondary">
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
