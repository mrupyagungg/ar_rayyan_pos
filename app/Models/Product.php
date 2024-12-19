<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product'; // Your custom table name
    protected $primaryKey = 'id_produk'; // Specify the custom primary key

    // List of columns that can be filled
    protected $fillable = ['id_produk', 'kode_produk', 'nama_produk', 'harga_produk', 'stok', 'kategori'];

    public function detailProduct()
    {
        return $this->hasMany(DetailProduct::class, 'id_produk', 'id_produk'); // Make sure the foreign key in DetailProduct is 'id_produk'
    }
}
