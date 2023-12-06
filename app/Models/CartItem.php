<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $table = 'cart_items';

    public function cart() {
        return $this->belongsTo('App\Models\Cart', 'cart_id', 'cart_id');
    }

    public function product_variant() {
        return $this->belongsTo('App\Models\ProductVariant', 'variant_id', 'variant_id');
    }
}
