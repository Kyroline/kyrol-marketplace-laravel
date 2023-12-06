@extends('layouts.user-layout', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.user.topnav', ['title' => 'User Management'])
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4">Product Details</h5>
                    <div class="row">
                        <div class="col-xl-5 col-lg-6 text-center">
                            <img class="w-100 border-radius-lg shadow-lg mx-auto" src="{{ asset('images/' . $product->image) }}" alt="chair">
                        </div>
                        <div class="col-lg-5 mx-auto">
                            <h3 class="mt-lg-0 mt-4">{{ $product->product_name }}</h3>
                            @if ($product->review->count() > 0)
                            <div class="row align-items-center">
                                <div class="col-4 rating">
                                    <i class="h4 fas text-center" data-star="4.5"></i>
                                </div>
                                <div class="col-lg-4">
                                    <span class="" id="amount-sold">40</span>
                                    Sold
                                </div>
                                <div class="col-lg-4">
                                    <span id="amount-reviewed">12</span>
                                    Review
                                </div>
                            </div>
                            @else
                            <div class="row align-items-center">
                                No review
                            </div>
                            @endif
                            <br>
                            <h6 class="mb-0 mt-3">Price</h6>
                            <h5>
                            <span id="price">
                            @if ($product->product_variant()->max('product_variants.price') == $product->product_variant()->min('product_variants.price'))
                                
                                @convert($product->product_variant()->max('product_variants.price'))
                            @else
                                @convert($product->product_variant()->min('product_variants.price')) -
                                @convert($product->product_variant()->max('product_variants.price'))
                            @endif
                            </span></h5>
                            <span class="badge badge-success">In Stock</span>
                            <br>
                            <span id="stockkk"></span>
                            <br>
                            <label class="mt-4">Description</label>
                            <ul>
                                <li>The most beautiful curves of this swivel stool adds an elegant touch to any
                                    environment</li>
                                <li>Memory swivel seat returns to original seat position</li>
                                <li>Comfortable integrated layered chair seat cushion design</li>
                                <li>Fully assembled! No assembly required</li>
                            </ul>
                            <form method="POST" action="{{ route('store.product.addtocart', [$store->store_domain, $product->product_id]) }}">
                                @csrf
                                <div class="row mt-4">
                                    <div class="col-lg-8 mt-lg-0 mt-2">
                                        <div class="form-group">
                                            <label for="slt-variant">Variant</label>
                                            <select class="form-control" id="slt-variant" name="variant_id">
                                                <option>Select a variant</option>
                                                @foreach ($product->product_variant as $variant)
                                                    <option value="{{ $variant->variant_id }}">{{ $variant->variant_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="qty" class="form-control-label">Qty</label>
                                            <input class="form-control" type="number" value="0" id="qty" name="qty">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-5">
                                        <button class="btn btn-primary mb-0 mt-lg-auto w-100" type="submit" name="button">Add to cart</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-5 col-12">
            <div class="card mb-3 mt-lg-0 mt-4">
                <div class="card-body pb-0">
                    <div class="row align-items-center mb-3">
                        <div class="col-9">
                            <h5 class="mb-1">
                                User Reviews
                            </h5>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        @if ($product->review->count() > 0)
                        <div class="col-7 text-end">
                            <h1>★ {{ number_format($product->review->sum('score') / $product->review->count(), 1) }}</h1>
                        </div>
                        <div class="col-5 text-left">
                            <h4>/ 5.0</h4>
                        </div>
                        @else
                        <div class="col-12 text-center">
                            <h1>No review</h1>
                        </div>
                        @endif
                    </div>
                    @if ($product->review->count() > 0)
                    <div class="row align-items-center">
                        <div class="col-2 align-middle text-center">
                            <i class="fas fa-star text-xs" aria-hidden="true"></i><span class="me-2 text-xs"> 5</span>
                        </div>
                        <div class="col-8 align-middle text-center">
                            <div class="progress">
                                <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="{{ $review5 / $review->count() * 100 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $review5 / $review->count() * 100 }}%;"></div>
                            </div>
                        </div>
                        <div class="col-2 align-middle text-center">
                            <span class="me-2 text-xs font-weight-bold">{{ $review5 }}</span>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-2 align-middle text-center">
                            <i class="fas fa-star text-xs" aria-hidden="true"></i><span class="me-2 text-xs"> 4</span>
                        </div>
                        <div class="col-8 align-middle text-center">
                            <div class="progress">
                                <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="{{ number_format($review4 / $review->count() * 100, 0) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $review4 / $review->count() * 100 }}%;"></div>
                            </div>
                        </div>
                        <div class="col-2 align-middle text-center">
                            <span class="me-2 text-xs font-weight-bold">{{ $review4 }}</span>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-2 align-middle text-center">
                            <i class="fas fa-star text-xs" aria-hidden="true"></i><span class="me-2 text-xs"> 3</span>
                        </div>
                        <div class="col-8 align-middle text-center">
                            <div class="progress">
                                <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="{{ $review3 / $review->count() * 100 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $review3 / $review->count() * 100 }}%;"></div>
                            </div>
                        </div>
                        <div class="col-2 align-middle text-center">
                            <span class="me-2 text-xs font-weight-bold">{{ $review3 }}</span>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-2 align-middle text-center">
                            <i class="fas fa-star text-xs" aria-hidden="true"></i><span class="me-2 text-xs"> 2</span>
                        </div>
                        <div class="col-8 align-middle text-center">
                            <div class="progress">
                                <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="{{ $review2 / $review->count() * 100 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $review2 / $review->count() * 100 }}%;"></div>
                            </div>
                        </div>
                        <div class="col-2 align-middle text-center">
                            <span class="me-2 text-xs font-weight-bold">{{ $review2 }}</span>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-2 align-middle text-center">
                            <i class="fas fa-star text-xs" aria-hidden="true"></i><span class="me-2 text-xs"> 1</span>
                        </div>
                        <div class="col-8 align-middle text-center">
                            <div class="progress">
                                <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="{{ $review1 / $review->count() * 100 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $review1 / $review->count() * 100 }}%;"></div>
                            </div>
                        </div>
                        <div class="col-2 align-middle text-center">
                            <span class="me-2 text-xs font-weight-bold">{{ $review1 }}</span>
                        </div>
                    </div>
                    
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-12">
                @foreach($product->review as $review)
                <div class="card mb-2">
                    <div class="card-header d-flex align-items-center border-bottom py-3">
                        <div class="d-flex align-items-center">
                            <a href="javascript:;">
                                <img src="/assets/img/team-4.jpg" class="avatar" alt="profile-image">
                            </a>
                            <div class="mx-3">
                                <a href="javascript:;" class="text-dark font-weight-600 text-sm">{{$review->user->username}}</a>
                                <!-- <small class="d-block text-muted">Moments ago</small> -->
                            </div>
                        </div>

                        <i class="h4 fas text-center" data-star="{{ number_format($review->score, 1) }}"></i>
                    </div>
                    <div class="card-body">
                        <p class="mb-2">
                        {{$review->review}}
                        </p>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
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
        var variantPrice = new Map([
            @foreach ($product->product_variant as $variant)
            [ "{{ $variant->variant_id }}", "@convert($variant->price)" ],
            @endforeach
        ]);

        var variantStock = new Map([
            @foreach ($product->product_variant as $variant)
            [ "{{ $variant->variant_id }}", {{ $variant->stock }} ],
            @endforeach
        ]);

        var selectedOption;
        $(document).ready(function() {
            $("#slt-variant").change(function() {
                var selectedVariant = $('#slt-variant').val();
                $('#price').text(variantPrice.get(selectedVariant));
                $("#qty").val("");
                $("#qty").attr({
                    "max": variantStock.get(selectedVariant),
                    "min": 1
                });
                $("#stockkk").text("Stock: " + variantStock.get(selectedVariant))
            });

            $('#qty').on('keydown keyup change', function(e) {
                if ($(this).val() > $(this).attr("max") &&
                    e.keyCode !== 46 // delete
                    &&
                    e.keyCode !== 8 // backspace
                ) {
                    e.preventDefault();
                    $(this).val($(this).attr("max"));
                }
            });
        });
    </script>
@endsection