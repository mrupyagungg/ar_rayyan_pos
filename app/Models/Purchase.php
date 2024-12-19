<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Purchase extends Model
{
    use HasFactory;
    protected $table = 'purchase'; // Nama tabel transaksi pembelian
    protected $fillable = ['id_beli', 'id','tanggal_beli','metode_bayar',  'stok', 'id_vendor','total', ];

    public function supplier()
{
    return $this->belongsTo(Supplier::class);
}
public function product()
{
    return $this->belongsTo(Product::class);
}

}
