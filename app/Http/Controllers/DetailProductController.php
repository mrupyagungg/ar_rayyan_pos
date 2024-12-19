<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\DetailProduct;
use App\Http\Requests\StoreDetailProductRequest;
use App\Http\Requests\UpdateDetailProductRequest;
use Illuminate\Http\Request;

class DetailProductController extends Controller
{
    public function show($id)
{
    $product = Product::with('detailProduct')->findOrFail($id); // eager load the detailProduct relationship
    return view('product.show', compact('product'));
}


    public function storeDetail(Request $request, $id)
    {
        $request->validate([
            'no_produk' => 'required|string|max:255',
            'stok' => 'required|integer',
            'tgl_expired' => 'required|date',
        ]);

        $product = Product::findOrFail($id);

        // Menyimpan data detail produk
        $product->detailProduct()->create([
            'no_produk' => $request->no_produk,
            'stok' => $request->stok,
            'tgl_expired' => $request->tgl_expired,
        ]);
        $notification = array(
            'message' => 'Data detail produk berhasil ditambah!',
            'alert-type' => 'success'
        );

        return redirect()->route('detail_product.show', $id)->with($notification);
    }

    // Mengedit detail produk
    public function editDetail($id)
    {
        $detail = DetailProduct::findOrFail($id);
        return response()->json($detail);
    }

    // Memperbarui detail produk
    public function updateDetail(Request $request, $id)
    {
        $request->validate([
            'no_produk' => 'required|string|max:255',
            'stok' => 'required|integer',
            'tgl_expired' => 'required|date',
        ]);

        $detail = DetailProduct::findOrFail($id);
        $detail->update([
            'no_produk' => $request->no_produk,
            'stok' => $request->stok,
            'tgl_expired' => $request->tgl_expired,
        ]);
        $notification = array(
            'message' => 'Data detail produk berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('detail_product.show', $detail->id_produk)->with($notification);
    }

    // Menghapus detail produk
    public function destroy($id)
    {
        //hapus dari database
        $detail = DetailProduct::findOrFail($id);
        $productId = $detail->id_produk;
        $detail->delete();

        $notification = array(
            'message' => 'Data detail produk berhasil dihapus!',
            'alert-type' => 'success'
        );

        return redirect()->route('detail_product.show', $productId)->with($notification);
    }

}
