<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $table = 'invoice_items';

    protected $primaryKey = 'invoice_item_id';

    protected $keyType = 'string';

    public function invoice() {
        return $this->belongsTo('App\Models\Invoice', 'invoice_id');
    }

    public function product() {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function product_variant() {
        return $this->belongsTo('App\Models\ProductVariant', 'variant_id');
    }
}
