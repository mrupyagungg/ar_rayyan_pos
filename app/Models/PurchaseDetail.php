<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $fillable = ['purchase_id', 'product_id', 'quantity', 'subtotal'];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}