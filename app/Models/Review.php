<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    public function product_variant() {
        return $this->belongsTo('App\Models\ProductVariant', 'variant_id');
    }

    public function product() {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
