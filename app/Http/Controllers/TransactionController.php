<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; // untuk query 

class TransactionController extends Controller
{
    public function index(){
        $transactions = Transaction::latest()->get();

        return view('transactions.index', compact('transactions'));
    }

    public function store(Request $request)
    {
        $params = $request->all();

        // Transaction logic inside a DB transaction
        $transaction = \DB::transaction(function() use ($params) {
            // Generate transaction parameters
            $transactionParams = [
                'transaction_code' => 'J-10' . mt_rand(1, 1000),
                'nama_kasir' => auth()->user()->name,
                'nama_customer' => $params['nama_customer'],
                'metode_bayar' => $params['metode_bayar'],
                'total_price' => $params['total'],
                'accept' => $params['accept'],
                'return' => $params['return'],
            ];

            // Create a new transaction
            $transaction = Transaction::create($transactionParams);

            // Process each product in the cart
            foreach ($params['products'] as $productId => $productData) {
                // Proses produk dan quantity
                $product = Product::findOrFail($productId);
                // Proses transaksi dan detail produk
                $orderProductParams = [
                    'transaction_id' => $transaction->id,
                    'id_produk' => $product->id,
                    'qty' => $productData['quantity'], // Ensure the updated quantity is used
                    'nama_produk' => $product->nama_produk,
                    'base_price' => $product->harga_produk,
                    'base_total' => $product->harga_produk * $productData['quantity'], // Base total calculation with quantity
                ];
                // Tambahkan ke detail transaksi
                TransactionDetail::create($orderProductParams);
            }

            return $transaction;
        });

        // After the transaction, log journal entries
        if ($transaction) {
            DB::table('jurnal')->insert([
                'id_transaksi' => $transaction->transaction_code,
                'kode_akun' => '101',
                'tgl_jurnal' => $transaction->created_at,
                'posisi_d_c' => 'd',
                'nominal' => $transaction->total_price,
                'kelompok' => 1,
                'transaksi' => 'penjualan',
            ]);

            DB::table('jurnal')->insert([
                'id_transaksi' => $transaction->transaction_code,
                'kode_akun' => '401',
                'tgl_jurnal' => $transaction->created_at,
                'posisi_d_c' => 'c',
                'nominal' => $transaction->total_price,
                'kelompok' => 1,
                'transaksi' => 'penjualan',
            ]);

            return redirect()->route('transactions.show', $transaction->id)->with([
                'message' => 'Success order',
                'alert-type' => 'success'
            ]);
        }

        return redirect()->back()->with([
            'message' => 'Failed to process transaction',
            'alert-type' => 'danger'
        ]);
    }
   
    
    public function show(Transaction $transaction){
        return view('transactions.show', compact('transaction'));
    }

    public function destroy(Transaction $transaction){
       
        $transaction->delete();

        return redirect()->back()->with([
            'message' => 'success delete',
            'alert-type' => 'danger'
        ]);
    }

    public function print_struck(Transaction $transaction){        
        
        return view('transactions.nota', compact('transaction'));
    }
}
