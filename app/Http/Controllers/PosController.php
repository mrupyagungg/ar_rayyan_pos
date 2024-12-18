<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\DetailProduct;
use App\Models\Supplier;

use App\Http\Controllers\Controller;

class PosController extends Controller
{
    public function index()
    {
        // Ambil produk dan detail produk
        $products = Product::with('detailProduct')->get();
    
        // Menentukan variabel minDetailProduct, misalnya untuk mengambil detail produk dengan stok paling sedikit
        $minDetailProduct = $products->flatMap(function ($product) {
            return $product->detailProduct;
        })->sortBy('stok')->first(); // Menyortir berdasarkan stok dan mengambil yang pertama
    
        // Ambil data suppliers
        $suppliers = Supplier::all();
    
        // Kirimkan data ke view
        return view('pos.index', compact('products', 'minDetailProduct', 'suppliers'));
    }
}
