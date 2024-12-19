<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with('detailProduct')->get(); // Mengambil semua produk beserta relasi detail_product

        // Jika perlu, bisa menambahkan total stok untuk setiap produk
        foreach ($product as $p) {
            $p->total_stok = $p->detailProduct->sum('stok'); // Menghitung total stok dari detail_product
        }

        return view('product.index', compact('product')); // Ganti dengan nama view yang sesuai
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required',
            'nama_produk' => 'required',
            'kategori' => 'required',
            'harga_produk' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);
        $duplicate = Product::where('kode_produk', $request->input('kode_produk'))->exists();

        if ($duplicate) {
            // Jika kode_produk akun sudah ada, redirect kembali dengan pesan error
            $notification = array(
                'message' => 'Kode_produk produk sudah ada!',
                'alert-type' => 'error'
            );
            return redirect()->route('product.index')->with($notification);
        }

        Product::create($request->all());

        $notification = array(
            'message' => 'Data produk berhasil ditambah!',
            'alert-type' => 'success'
        );
 
        return redirect()->route('product.index')->with($notification);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_produk' => 'required',
            'nama_produk' => 'required',
            'kategori' => 'required',
            'harga_produk' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $duplicate = Product::where('kode_produk', $request->input('kode_produk'))
                        ->where('id', '!=', $id) 
                        ->exists();

        if ($duplicate) {
            $notification = array(
                'message' => 'Kode_produk produk sudah ada!',
                'alert-type' => 'error'
            );
            return redirect()->route('product.index')->with($notification);
        }

        $product = Product::findOrFail($id);
        $product->update($request->all());

        $notification = array(
            'message' => 'Data produk berhasil diubah!',
            'alert-type' => 'success'
        );

        return redirect()->route('product.index')->with($notification);
    }

    public function destroy($id)
    {
        //hapus dari database
        $product = Product::findOrFail($id);
        $product->delete();

        $notification = array(
            'message' => 'Data produk berhasil dihapus!',
            'alert-type' => 'success'
        );

        return redirect()->route('product.index')->with($notification);
    }

    public function show($id)
    {
        $product = Product::with('detailProduct')->findOrFail($id);
        
        return view('product.show', compact('product'));
    }


}
