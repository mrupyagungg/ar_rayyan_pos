<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\DetailProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{

    public function index()
    {
        $purchase = Purchase::with(['supplier', 'product'])->get();
        $supplier = Supplier::all();
        $products = Product::all();
    
        return view('purchase.index', compact('purchase', 'supplier', 'products'));
    }

    public function create()
    {
        // Ambil semua data supplier dan produk
        $supplier = Supplier::all();
        $products = Product::all();

        return view('purchase.create', compact('supplier', 'products'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'supplier_id' => 'required|exists:suppliers,id',
        'tgl_beli' => 'required|date',
        'metode_bayar' => 'required|in:Tunai,Transfer',
        'products' => 'required|array',
        'products.*.quantity' => 'required|integer|min:1',
        'total' => 'required|numeric|min:0',
    ]);

    try {
        // Simpan data pembelian ke tabel 'purchases'
        $purchase = Purchase::create([
            'supplier_id' => $validated['supplier_id'],
            'tgl_beli' => $validated['tgl_beli'],
            'metode_bayar' => $validated['metode_bayar'],
            'total' => $validated['total'],
        ]);

        // Simpan detail pembelian ke tabel 'purchase_details'
        foreach ($validated['products'] as $productId => $product) {
            $purchase->details()->create([
                'product_id' => $productId,
                'quantity' => $product['quantity'],
                'subtotal' => Product::findOrFail($productId)->harga_produk * $product['quantity'],
            ]);
        }

        return redirect()->route('purchase.index')->with('success', 'Data pembelian berhasil disimpan!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

}