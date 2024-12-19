<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    // Use guarded to avoid mass-assignment on specific fields
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // If you plan to use relationships, you can define them here
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }
}
