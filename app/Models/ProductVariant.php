<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $table = 'product_variants';

    protected $primaryKey = 'variant_id';

    protected $keyType = 'string';

    protected $fillable = [
        'product_id',
        'variant_id',
        'variant_name',
        'price',
        'stock'
    ];

    public function product() {
        return $this->belongsTo('App\Models\Product', 'product_id', 'product_id');
    }
}
