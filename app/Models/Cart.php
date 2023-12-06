<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $primaryKey = 'cart_id';

    protected $keyType = 'string';

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function store() {
        return $this->belongsTo('App\Models\Store', 'store_id');
    }

    public function cart_item() {
        return $this->hasMany('App\Models\CartItem', 'cart_id', 'cart_id');
    }
}
