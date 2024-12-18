<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LapProductTerjualController extends Controller
{
    public function product_terjual(Request $request)
    {
        $startDate = $request->input('start_date');
		$endDate = $request->input('end_date');

		// Jika tanggal start dan end telah diberikan
		if ($startDate && $endDate) {
			$products = Product::all();

			$salesReports = [];
			$grandTotalRevenue = 0; // Variabel untuk menyimpan grand total pendapatan
			foreach ($products as $product) {
				$totalSales = TransactionDetail::where('id_produk', $product->id)
					->whereBetween('created_at', [$startDate, $endDate])
					->sum('qty');
				$totalRevenue = $totalSales * $product->harga_produk;
				$grandTotalRevenue += $totalRevenue; // Tambahkan total pendapatan dari produk saat ini ke grand total
				$salesReports[] = [
					'product' => $product,
					'total_sales' => $totalSales,
					'total_revenue' => $totalRevenue
				];
			}
		} else {
			// Jika tanggal start dan end tidak diberikan, ambil semua data
			$salesReports = [];
			$grandTotalRevenue = 0;
		}

		return view('reports.product_terjual', compact('salesReports','startDate', 'endDate','grandTotalRevenue'));
	}

	public function printPDF(Request $request)
	{
		$startDate = $request->input('start_date');
		$endDate = $request->input('end_date');

		// Jika tanggal start dan end telah diberikan
		if ($startDate && $endDate) {
			$products = Product::all();

			$salesReports = [];
			$grandTotalRevenue = 0; // Variabel untuk menyimpan grand total pendapatan
			foreach ($products as $product) {
				$totalSales = TransactionDetail::where('id_produk', $product->id)
					->whereBetween('created_at', [$startDate, $endDate])
					->sum('qty');
				$totalRevenue = $totalSales * $product->harga_product;
				$grandTotalRevenue += $totalRevenue; // Tambahkan total pendapatan dari product saat ini ke grand total
				$salesReports[] = [
					'product' => $product,
					'total_sales' => $totalSales,
					'total_revenue' => $totalRevenue
				];
			}
		} else {
			// Jika tanggal start dan end tidak diberikan, ambil semua data
			$salesReports = [];
			$grandTotalRevenue = 0;
		}

		$pdf = PDF::loadView('reports.exports.product_terjual-pdf', compact('salesReports', 'startDate', 'endDate','grandTotalRevenue'));

		return $pdf->download('laporan_penjualan.pdf');
	}

}
