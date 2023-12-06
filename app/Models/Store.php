<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'stores';

    protected $primaryKey = 'store_id';

    protected $keyType = 'string';

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function product() {
        return $this->hasMany('App\Models\Product', 'store_id', 'store_id');
    }

    public function category() {
        return $this->hasMany('App\Models\Category', 'store_id', 'store_id');
    }

    public function invoice() {
        return $this->hasMany('App\Models\Invoice', 'store_id', 'store_id');
    }
}
