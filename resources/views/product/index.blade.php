@extends('layouts.dashboardmaster')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div>
                    <div class="d-flex justify-content-end">
                        <a href="" class="btn btn-dark m-3 px-4">
                            <i class="fas fa-plus"></i> Add Category
                        </a>
                        <a href="{{ route('product.create') }}" class="btn btn-dark m-3 px-4">
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

@endsection
