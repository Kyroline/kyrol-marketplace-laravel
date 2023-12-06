@extends('layouts.admin-layout', ['title' => 'Kyroshopu | Products'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card" id="password">
                <div class="card-header">
                    <h5>New Category</h5>
                </div>
                <div class="card-body pt-0">
                    <form action="{{ route('store.category.store') }}" method="POST">
                        @csrf
                        <label class="form-label">Name</label>
                        <div class="form-group">
                            <input class="form-control" id="name" name="name" type="text" placeholder="Category" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>
                        <div class="form-group row">
                            <input class="btn bg-gradient-dark btn-sm float-end mt-0 mb-0" type="submit" value="Submit">
                        </div>
                    </form>
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