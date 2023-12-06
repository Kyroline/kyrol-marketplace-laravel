<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $primaryKey = 'product_id';

    protected $keyType = 'string';

    protected $fillable = [
        'product_id',
        'product_name'
    ];

    public function store() {
        return $this->belongsTo('App\Models\Store', 'store_id');
    }

    public function product_variant() {
        return $this->hasMany('App\Models\ProductVariant', 'product_id', 'product_id');
    }

    public function product_category () {
        return $this->hasMany('App\Models\ProductCategory', 'product_id', 'product_id');
    }

    public function category() {
        return $this->belongsToMany('App\Models\Category', 'product_categories', 'product_id', 'category_id');
    }

    public function review() {
        return $this->hasMany('App\Models\Review', 'product_id');
    }
}
