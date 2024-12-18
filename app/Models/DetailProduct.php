<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailProduct extends Model
{
    use HasFactory;
    protected $table = 'detail_product'; // Nama tabel
    protected $fillable = ['id','id_produk', 'no_produk', 'stok', 'tgl_expired']; // Kolom yang bisa diisi

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id'); // Menggunakan 'id_produk' di DetailProduct dan 'id' di Product
    }
}
