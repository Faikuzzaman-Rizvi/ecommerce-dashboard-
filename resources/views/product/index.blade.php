@extends('layouts.dashboardmaster')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div>
                    <div class="d-flex justify-content-end">
                        <a href="#" class="btn btn-primary m-3 px-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i class="fas fa-plus"></i> Add Category
                        </a>
                        <a href="{{ route('products.create') }}" class="btn btn-primary m-3 px-4">
                            <i class="fas fa-plus"></i> Add Product
                        </a>
                    </div>

                    <div class="d-flex flex-wrap justify-content-between gap-3 m-3">
                        <!-- Search Bar 1 (Left-aligned) -->
                        <div class="position-relative" style="flex: 1; max-width: 300px;">
                            <input
                                type="text"
                                name="search1"
                                class="form-control ps-5"
                                placeholder="Search by ID Name Category"
                                style="height: 40px; font-size: 14px;">
                            <i class="fas fa-search position-absolute"
                               style="top: 50%; left: 15px; transform: translateY(-50%); color: #6c757d;"></i>
                        </div>

                        <!-- Right-aligned Search Bars -->
                        <div class="d-flex gap-3" style="flex: 1; justify-content: flex-end; max-width: 500px;">
                            <!-- Search Bar 3 (Search by Status with Dropdown) -->
                            <div class="position-relative" style="flex: 1; max-width: 200px;">
                                <input
                                    type="text"
                                    class="form-control ps-5"
                                    placeholder="Search by Status"
                                    style="height: 40px; font-size: 14px;"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-caret-down position-absolute"
                                   style="top: 50%; right: 15px; transform: translateY(-50%); color: #6c757d; cursor: pointer;"
                                   data-bs-toggle="dropdown" aria-expanded="false"></i>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Active</a></li>
                                    <li><a class="dropdown-item" href="#">Inactive</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Archived</a></li>
                                </ul>
                            </div>

                            <!-- Search Bar 4 (Sort Search with Dropdown) -->
                            <div class="position-relative" style="flex: 1; max-width: 200px;">
                                <input
                                    type="text"
                                    class="form-control ps-5"
                                    placeholder="Sort Search"
                                    style="height: 40px; font-size: 14px;"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-sort position-absolute"
                                   style="top: 50%; right: 15px; transform: translateY(-50%); color: #6c757d; cursor: pointer;"
                                   data-bs-toggle="dropdown" aria-expanded="false"></i>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Ascending</a></li>
                                    <li><a class="dropdown-item" href="#">Descending</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-0" id="table1">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Sells</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td><img src="path/to/image.jpg" alt="Product Image" style="width: 50px; height: 50px;"></td>
                                    <td>The Bird</td>
                                    <td>Twitter</td>
                                    <td>Available</td>
                                    <td>150</td>
                                    <td>Popular social media platform</td>
                                    <td>Active</td>
                                    <td>
                                        <a href="" class="text-primary me-3" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="" class="text-warning me-3" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="" class="text-danger me-0" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" style="background-color:#6c757d02,opacity: 0.11;" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Category</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form to add category -->
          <form action="" method="POST">
            @csrf
            <div class="mb-3">
                <label for="categoryName" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="categoryName" name="name" required>
            </div>
            <div class="mb-3">
                <label for="categoryDescription" class="form-label">Description</label>
                <textarea class="form-control" id="categoryDescription" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="categoryStatus" class="form-label">Status</label>
                <select class="form-select" id="categoryStatus" name="status" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Category</button>
            </div>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection
