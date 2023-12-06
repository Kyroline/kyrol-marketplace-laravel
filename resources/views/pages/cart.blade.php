@extends('layouts.user-layout', ['class' => 'g-sidenav-show bg-gray-100', 'title' => 'Cart | Kyroshopu'])

@section('content')
@include('layouts.navbars.auth.user.topnav', ['title' => 'User Management'])
<div class="container-fluid py-4">
    <form action="{{ route('user.checkout') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        @foreach ($carts as $cart)
                        <div class="form-check mt-2 ms-3">
                            <input class="form-check-input" type="radio" name="cart_id" value="{{ $cart->cart_id }}">
                            <label class="custom-control-label">
                                {{ $cart->store->store_name }}</label>
                        </div>
                        <div class="table table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Product</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Price</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Qty</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart->cart_item as $product)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ asset('images/' . $product->product_variant->product->image) }}" class="avatar avatar-md me-3" alt="table image">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <a href="{{ route('store.product', [$cart->store->store_domain, $product->product_variant->product->product_id]) }}">
                                                        <h6 class="mb-0 text-sm">{{ $product->product_variant->product->product_name }} ({{ $product->product_variant->variant_name }})</h6>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm text-secondary mb-0">{{ $product->product_variant->price }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm text-secondary mb-0">{{ $product->qty }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm text-secondary mb-0">{{ $product->product_variant->price * $product->qty }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <!-- <button class="btn btn-danger btn-xs"></button> -->
                                            <a href="{{ route('user.shoppingcart.remove', [$cart->cart_id, $product->product_variant->variant_id]) }}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="cart-price">

                            </div>
                            
                            <button id="submit" class="btn btn-primary w-100 mt-3" type="submit">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
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
<script>
    $("#province").change(function() {
        var selectedVariant = $(this).children("option:selected").val();
        var selectedProvince = $(this).children("option:selected").text();
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "{{ route('api.rajaongkir.getcity') }}",
            data: {
                province: selectedVariant
            },
            success: function(msg) {
                $("select#kota_tujuan").html(msg);
            }
        });
    });
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            dataType: "html",
            url: "{{ route('api.rajaongkir.getprovince') }}",
            success: function(msg) {
                $("select#province").html(msg);
            }
        });
    });
    $('input[type=radio][name=cart_id]').change(function() {
        var selectedID = $(this).val()
        $('#submit').prop('disabled', true);
        $("div#cart-price").html(
            "<div class=\"d-flex justify-content-center\"><div class=\"spinner-border\" role=\"status\"><span class=\"sr-only\">Loading...</span></div></div>"
        );
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "{{ route('cart.updateprice') }}",
            data: {
                cart_id: selectedID
            },
            success: function(msg) {
                $("div#cart-price").html(msg);
                $('#submit').prop('disabled', false);
            }
        });
    });
</script>
@endsection