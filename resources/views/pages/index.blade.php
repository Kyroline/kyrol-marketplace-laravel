@extends('layouts.user-layout', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.user.topnav', ['title' => 'User Management'])
<div class="container-fluid py-4">
    <section class="py-3">
        <div class="row">
            <div class="col-md-8 me-auto text-left">
            </div>
        </div>
        <div class="row mt-lg-4 mt-2">
            @foreach ($products as $product)
            <div class="col-lg-2 col-md-3 mb-4 text-dark">
                <div class="card">
                    <img class="bg-gadient-dark" src="{{ asset('images/' . $product->image) }}" alt="slack_logo">
                    <div class="card-body p-3">
                        <div class="">
                        <p class="text-sm" style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 2; overflow: hidden;"><a href="{{ route('store.product', [$product->store->store_domain, $product->product_id]) }}">
                            {{ $product->product_name }}</a><br>
                            <a href="{{ route('user.store', $product->store->store_domain) }}">{{ $product->store->store_name }}</a><br>
                            {{ $product->store->province}}, {{ $product->store->city}}
                        </p>
                        
                        </div>
                        
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