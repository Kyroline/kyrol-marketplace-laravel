<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_categories';

    protected $fillable = [
        'category_id',
        'product_id'
    ];
    public $timestamps = false;
    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function product() {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
