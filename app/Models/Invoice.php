<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $primaryKey = 'invoice_id';

    protected $keyType = 'string';

    // protected $fillable = [

    // ];
    public function store () {
        return $this->belongsTo('App\Models\store', 'store_id');
    }

    public function user () {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function invoice_item() {
        return $this->hasMany('App\Models\InvoiceItem', 'invoice_id', 'invoice_id');
    }
}
