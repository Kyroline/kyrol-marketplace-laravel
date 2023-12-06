@extends('layouts.user-layout', ['class' => 'g-sidenav-show bg-gray-100', 'title' => 'Checkout | Kyroshopu'])

@section('content')
@include('layouts.navbars.auth.user.topnav', ['title' => 'User Management'])
<div class="container-fluid py-4">

    <form action="{{ route('user.checkout.store') }}" method="post">
        @csrf
        <input type="hidden" id="cart-id" name="cart_id" value="{{ $cart->cart_id }}">
        <div class="row">
            <div class="col-8">
                <div class="col-12 mb-4">
                    <div class="card" id="password">
                        <div class="card-header">
                            <div class="row mb-2">
                                <div class="col-8">
                                    <h5>Delivery Address</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <select class="form-control" name="address">
                                        <option value="">Select address</option>
                                        @foreach ($address as $add)
                                        <option value="{{$add->id}}">{{ $add->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <a href="{{route('user.address.add')}}" class="float-end">
                                    Add New Address
                                        <!-- <button class="btn bg-gradient-dark btn-sm float-end mt-0 mb-0" type=""></button> -->
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div id="address-card">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-check mt-2 ms-3">
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
                                                Qty</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Total</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Weight (gr)</th>
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
                                            <td class="align-middle text-sm">
                                                <p class="text-sm text-secondary mb-0">{{ $product->qty }}</p>
                                            </td>
                                            <td class="align-middle text-sm">
                                                <p class="text-sm text-secondary mb-0"> @convert($product->product_variant->price * $product->qty)</p>
                                            </td>
                                            <td class="align-middle text-sm">
                                                <p class="text-sm text-secondary mb-0">{{ $product->qty * $product->product_variant->weight }} gr</p>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <select class="form-control" id="courier" name="courier" required="">
                                <option value="jne">JNE</option>
                                <option value="tiki">TIKI</option>
                                <option value="pos">POS INDONESIA</option>
                            </select>
                            <div id="courier-price">

                            </div>
                        </div>
                    </div>
                </div>
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
    $('select[name=address]').change(function() {
        var selectedID = $(this).val()
        $('#submit').prop('disabled', true);
        $("div#address-card").html(
            "<div class=\"d-flex justify-content-center\"><div class=\"spinner-border\" role=\"status\"><span class=\"sr-only\">Loading...</span></div></div>"
        );
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "{{ route('checkout.updateaddress') }}",
            data: {
                address_id: selectedID
            },
            success: function(msg) {
                $("div#address-card").html(msg);
                $("div#cart-price").html(
                    "<div class=\"d-flex justify-content-center\"><div class=\"spinner-border\" role=\"status\"><span class=\"sr-only\">Loading...</span></div></div>"
                );
                $.ajax({
                    type: "POST",
                    dataType: "html",
                    url: "{{ route('api.rajaongkir.getfee') }}",
                    data: {
                        address_id: selectedID,
                        cart_id: $('#cart-id').val(),
                        courier: $('select[name=courier]').val()
                    },
                    success: function(msg) {
                        $("div#cart-price").html(msg);
                        $('#submit').prop('disabled', false);
                    }
                });
            }
        });
    });
    $('select[name=courier]').change(function() {
        
        if ($('select[name=address]').val() != null) {
            $('#submit').prop('disabled', true);
            $("div#cart-price").html(
                "<div class=\"d-flex justify-content-center\"><div class=\"spinner-border\" role=\"status\"><span class=\"sr-only\">Loading...</span></div></div>"
            );
            var selectedAddress = $('select[name=address]').val()
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ route('api.rajaongkir.getfee') }}",
                data: {
                    address_id: selectedAddress,
                    cart_id: $('#cart-id').val(),
                    courier: $('select[name=courier]').val()
                },
                success: function(msg) {
                    $("div#cart-price").html(msg);
                    $('#submit').prop('disabled', false);
                }
            });
        }
    });
</script>
@endsection