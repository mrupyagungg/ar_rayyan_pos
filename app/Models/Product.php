<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    // list kolom yang bisa diisi
    protected $fillable = ['id','kode','nama_produk','harga_produk','stok','kategori'];

    public function detailProduct()
    {
        return $this->hasMany(DetailProduct::class, 'id_produk', 'id'); // Pastikan foreign key di detail_product adalah 'id_produk'
    }
}
