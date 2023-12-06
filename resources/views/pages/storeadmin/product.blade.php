@extends('layouts.admin-layout', ['title' => 'Kyroshopu | Products'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">All Products</h5>
                            <!-- <p class="text-sm mb-0">
                                A lightweight, extendable, dependency-free javascript HTML table plugin.
                            </p> -->
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="{{ route('store.product.add') }}" class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New Product</a>
                                <button type="button" class="btn btn-outline-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#import">
                                    Import
                                </button>
                                <div class="modal fade" id="import" tabindex="-1" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog mt-lg-10">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalLabel">Import CSV</h5>
                                                <i class="fas fa-upload ms-3" aria-hidden="true"></i>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>You can browse your computer for a file.</p>
                                                <input type="text" placeholder="Browse file..." class="form-control mb-3" onfocus="focused(this)" onfocusout="defocused(this)">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="importCheck" checked="">
                                                    <label class="custom-control-label" for="importCheck">I accept the
                                                        terms and conditions</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn bg-gradient-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn bg-gradient-primary btn-sm">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-0">
                    <div class="table-responsive">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="dataTable-top">
                            </div>
                            <div class="dataTable-container">
                                <table class="table table-flush dataTable-table" id="products-list">
                                    <thead class="thead-light">
                                        <tr class="text-sm">
                                            <th data-sortable="" style="width: 105.043%;">Product</th>
                                            <th data-sortable="" style="width: 41.1187%;">Category</th>
                                            <th data-sortable="" style="width: 41.4642%;">Variant</th>
                                            <th data-sortable="" style="width: 48.0294%;">Status</th>
                                            <th data-sortable="" style="width: 45.2651%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($store->product as $product)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <img class="w-10 ms-3" src="{{ asset('images/' . $product->image) }}">
                                                    <h6 class="ms-3 my-auto">{{ $product->product_name }}</h6>
                                                </div>
                                            </td>
                                            <td class="text-sm">Clothing</td>
                                            <td class="text-sm">{{ $product->product_variant->count() }}</td>
                                            <td class="text-sm">0</td>
                                            <td>
                                                <span class="badge badge-danger badge-sm">Out of Stock</span>
                                            </td>
                                            <td class="text-sm">
                                                <a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
                                                    <i class="fas fa-eye text-secondary" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('store.product.edit', explode('-', $product->product_id)[1]) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit product">
                                                    <i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
                                                </a>
                                                <a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Delete product">
                                                    <i class="fas fa-trash text-secondary" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <!-- <div class="dataTable-bottom">
                                <div class="dataTable-info">Showing 1 to 7 of 15 entries</div>
                                <nav class="dataTable-pagination">
                                    <ul class="dataTable-pagination-list">
                                        <li class="pager"><a href="#" data-page="1">‹</a></li>
                                        <li class="active"><a href="#" data-page="1">1</a></li>
                                        <li class=""><a href="#" data-page="2">2</a></li>
                                        <li class=""><a href="#" data-page="3">3</a></li>
                                        <li class="pager"><a href="#" data-page="2">›</a></li>
                                    </ul>
                                </nav>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer pt-3  ">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>2023,
                        made with <i class="fa fa-heart" aria-hidden="true"></i> by
                        <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                        &amp;
                        <a href="https://www.updivision.com" class="font-weight-bold" target="_blank">UPDIVISION</a>
                        for a better web.
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item">
                            <a href="https://www.updivision.com" class="nav-link text-muted" target="_blank">UPDIVISION</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection