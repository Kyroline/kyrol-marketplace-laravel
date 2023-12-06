@foreach($cart_items as $item)
<div class="row text-sm">
    <div class="col-7">
        {{ $item->qty }} x {{ $item->product_variant->product->product_name }} ({{ $item->product_variant->variant_name }})
    </div>
    <div class="col-5">
        @convert($item->product_variant->price)
    </div>
</div>
@endforeach
<hr>
<div class="row">
    <div class="col-7">
        Total Price ({{ $cart_items->sum('qty') }} items)
    </div>
    <div class="col-5">
        @convert($total)
    </div>
</div>