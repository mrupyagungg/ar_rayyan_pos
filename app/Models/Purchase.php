<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Purchase extends Model
{
    use HasFactory;
    protected $table = 'purchase'; // Nama tabel transaksi pembelian
    protected $fillable = ['id_beli', 'tgl_beli','metode_bayar',  'total_beli', 'id_vendor', 'quantity','total', ];

    // Relasi dengan Supplier
    public function details()
    {
        return $this->hasMany(PurchaseDetail::class);
    }
}
