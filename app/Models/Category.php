<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $primaryKey = 'category_id';

    protected $keyType = 'string';

    public function store() {
        return $this->belongsTo('App\Models\Store', 'store_id');
    }

    public function product_category () {
        return $this->hasMany('App\Models\ProductCategory', 'category_id', 'category_id');
    }

    public function product() {
        return $this->belongsToMany('App\Models\Product', 'product_categories', 'category_id', 'product_id');
    }
}
