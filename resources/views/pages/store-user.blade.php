@extends('layouts.user-layout', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.user.topnav', ['title' => 'User Management'])
<div class="card shadow-lg mx-4 card-profile-bottom">
    <div class="card-body p-3">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="../../../assets/img/team-1.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ $store->store_name }}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        Public Relations
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                                <i class="ni ni-app"></i>
                                <span class="ms-2">App</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                                <i class="ni ni-email-83"></i>
                                <span class="ms-2">Messages</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                                <i class="ni ni-settings-gear-65"></i>
                                <span class="ms-2">Settings</span>
                            </a>
                        </li>
                        <div class="moving-tab position-absolute nav-link" style="padding: 0px; transition: all 0.5s ease 0s; transform: translate3d(0px, 0px, 0px); width: 69px;"><a class="nav-link mb-0 px-0 py-1 active d-flex align-items-center justify-content-center " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">-</a></div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4">
    <section class="py-3">
        <div class="row">
            <div class="col-md-8 me-auto text-left">
                <h5>Some of Our Awesome Projects</h5>
                <p>This is the paragraph where you can write more details about your projects. Keep you user engaged
                    by providing meaningful information.</p>
            </div>
        </div>
        <div class="row mt-lg-4 mt-2">
            @foreach ($store->product as $product)
            <div class="col-lg-2 col-md-3 mb-4 text-dark">
                <div class="card">
                    <img class="bg-gadient-dark" src="{{ asset('images/' . $product->image) }}" alt="slack_logo">
                    <div class="card-body p-3">
                        <p class="text-sm" style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 2; overflow: hidden;"><a href="{{ route('store.product', [$store->store_domain, $product->product_id]) }}">{{ $product->product_name }}</a></p>
                        <p class="text-sm">
                            @if ($product->product_variant()->max('product_variants.price') == $product->product_variant()->min('product_variants.price'))
                                @convert($product->product_variant()->max('product_variants.price'))
                            @else
                                Rp{{$product->product_variant()->max('product_variants.price')}} - Rp{{$product->product_variant()->min('product_variants.price')}}
                            @endif
                        </p>
                        
                        @if ($product->review->count() > 0)
                        <div class="row text-xs">
                            <div class="col-5">
                                <i class="fas fa-star text-yellow" aria-hidden="true"></i>
                                <span>{{ number_format($product->review->sum('score') / $product->review->count(), 1) }}</span>    
                            </div>
                            <div class="col-7">
                                <span>{{ $product->review->sum('qty')}}</span> Sold
                            </div>
                        </div>
                        @else
                        <div class="row text-xs">
                            <div class="col-3"></div>
                            <div class="col-6">
                            No review</div>
                            <div class="col-3"></div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </section>
    <footer class="footer pt-3">
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