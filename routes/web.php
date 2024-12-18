<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect('login');
});

Route::get('home',function () {
    return view('home');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

// route untuk validasi login
Route::post('/validasi_login', [App\Http\Controllers\LoginController::class, 'show']);

// route ke master data coa
Route::resource('coa', App\Http\Controllers\CoaController::class);
Route::post('coa', [App\Http\Controllers\CoaController::class, 'store'])->name('coa.store')->middleware(['auth']);
Route::put('/coa/{id}/update', [App\Http\Controllers\CoaController::class, 'update'])->name('coa.update')->middleware(['auth']);
Route::get('/coa/destroy/{id}', [App\Http\Controllers\CoaController::class,'destroy'])->middleware(['auth']);

// route master data Customer
Route::resource('/customer', App\Http\Controllers\CustomerController::class)->middleware(['auth']);
Route::get('/customer/destroy/{id}', [App\Http\Controllers\CustomerController::class,'destroy'])->middleware(['auth']);

// route ke master data supplier
Route::resource('supplier', App\Http\Controllers\SupplierController::class)->middleware(['auth']);
Route::get('/supplier/destroy/{id}', [App\Http\Controllers\SupplierController::class,'destroy'])->middleware(['auth']);

// route ke master data produk
Route::resource('product', App\Http\Controllers\ProductController::class)->middleware(['auth']);
Route::get('/product/destroy/{id}', [App\Http\Controllers\ProductController::class,'destroy'])->middleware(['auth']);

// detail produk
Route::get('detail_product/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('detail_product.show');
Route::post('product/{id}/detail', [App\Http\Controllers\DetailProductController::class, 'storeDetail'])->name('product.storeDetail');
Route::get('product/detail/{id}/edit', [App\Http\Controllers\DetailProductController::class, 'editDetail'])->name('product.editDetail');
Route::put('product/detail/{id}', [App\Http\Controllers\DetailProductController::class, 'updateDetail'])->name('product.updateDetail');
Route::get('/detail_product/destroy/{id}', [App\Http\Controllers\DetailProductController::class,'destroy'])->middleware(['auth']);

Route::get('purchase', [PurchaseController::class, 'index'])->name('purchase.index');
Route::post('/purchase/store', [PurchaseController::class, 'store'])->name('purchase.store');

//route ke transaksi Pengeluaran
Route::get('pengeluaran/tabel', [App\Http\Controllers\PengeluaranController::class,'tabel'])->middleware(['auth']);
Route::get('pengeluaran/fetchpurchase', [App\Http\Controllers\PengeluaranController::class,'fetchpurchase'])->middleware(['auth']);
Route::get('pengeluaran/fetchAll', [App\Http\Controllers\PengeluaranController::class,'fetchAll'])->middleware(['auth']);
Route::get('pengeluaran/edit/{id}', [App\Http\Controllers\PengeluaranController::class,'edit'])->middleware(['auth']);
Route::get('pengeluaran/destroy/{id}', [App\Http\Controllers\PengeluaranController::class,'destroy'])->middleware(['auth']);
Route::get('/pengeluaran/filter', 'App\Http\Controllers\PengeluaranController@filterByDate');
Route::resource('pengeluaran', App\Http\Controllers\PengeluaranController::class)->middleware(['auth']); 

// pos
Route::get('pos', [\App\Http\Controllers\PosController::class, 'index'])->name('pos.index');
    
// carts
Route::resource('carts', \App\Http\Controllers\CartController::class);
Route::post('carts/scan', [\App\Http\Controllers\CartController::class, 'scan'])->name('carts.scan');

// transaction
Route::get('transactions', [\App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index');
Route::get('transactions/{transaction}/print_struck', [\App\Http\Controllers\TransactionController::class, 'print_struck'])->name('transactions.print_struck');
Route::post('transactions', [\App\Http\Controllers\TransactionController::class, 'store'])->name('transactions.store');
Route::get('transactions/{transaction}', [\App\Http\Controllers\TransactionController::class, 'show'])->name('transactions.show');
Route::delete('transactions/{transaction}', [\App\Http\Controllers\TransactionController::class, 'destroy'])->name('transactions.destroy');

// laporan
Route::get('jurnal/umum', [App\Http\Controllers\JurnalController::class,'jurnalumum'])->middleware(['auth']);
Route::get('jurnal/viewdatajurnalumum/{periode}', [App\Http\Controllers\JurnalController::class,'viewdatajurnalumum'])->middleware(['auth']);
Route::get('jurnal/bukubesar', [App\Http\Controllers\JurnalController::class,'bukubesar'])->middleware(['auth']);
Route::get('jurnal/viewdatabukubesar/{periode}/{akun}', [App\Http\Controllers\JurnalController::class,'viewdatabukubesar'])->middleware(['auth']);
Route::get('reports/revenue', [\App\Http\Controllers\ReportController::class, 'revenue'])->name('reports.revenue');
Route::get('reports/product_terjual', [\App\Http\Controllers\LapProductTerjualController::class, 'product_terjual'])->name('reports.product_terjual');
Route::get('/print-pdf', [\App\Http\Controllers\LapProductTerjualController::class, 'printPDF'])->name('print_pdf');
Route::get('reports/pengeluaran', [\App\Http\Controllers\LapPengeluaranController::class, 'pengeluaran'])->name('reports.pengeluaran');
Route::get('reports/laba_rugi', [\App\Http\Controllers\LabarugiController::class, 'laba_rugi'])->name('reports.laba_rugi');

// laporan gaji
Route::get('laporan/slip-gaji/karyawan', [App\Http\Controllers\LaporanController::class, 'show'])->name('laporan.show');
Route::post('laporan/slip-gaji/karyawan', [App\Http\Controllers\LaporanController::class, 'cekGaji'])->name('laporan.karyawan');

// Profile
Route::get('/profil', [App\Http\Controllers\UserController::class, 'profil'])->name('user.profil');
Route::post('/profil', [App\Http\Controllers\UserController::class, 'updateProfil'])->name('user.update_profil');

// grafik
Route::get('grafik/viewPenjualanBlnBerjalan', [App\Http\Controllers\GrafikController::class,'viewBulanBerjalan'])->middleware(['auth']);

// calendar
Route::get('fullcalendar', [\App\Http\Controllers\FullcalendarController::class, 'index'])->name('fullcalendar');
require __DIR__.'/auth.php';
