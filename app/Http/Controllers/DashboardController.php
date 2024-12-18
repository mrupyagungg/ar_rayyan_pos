<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Purchase;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $product = Product::count();
        $transaction = Transaction::whereDate('created_at', Carbon::today())->count();
        $tanggal_hari_ini = Carbon::today()->toDateString();
        $revenuetoday = Transaction::whereDate('created_at', $tanggal_hari_ini)->sum('total_price');
        $supplier = Supplier::count();

        $results = DB::select("
            SELECT a.waktu, IFNULL(b.total, 0) AS total 
            FROM v_waktu a 
            LEFT OUTER JOIN (
                SELECT DATE_FORMAT(created_at,'%Y-%m') AS waktu,
                    SUM(total_price) AS total
                FROM transactions
                GROUP BY DATE_FORMAT(created_at,'%Y-%m')
            ) b ON (a.waktu=b.waktu)
        ");

        $labels = [];
        $totals = [];

        foreach ($results as $result) {
            $labels[] = $result->waktu;
            $totals[] = $result->total;
        }

        $total_revenue = 0;
     
        $total_pengeluaran = 0;
        $laba_rugi = 0;
        $total_laba_rugi = 0;

        $tanggal_awal = date('Y-m-01');
        $tanggal_akhir = date('Y-m-d');

        $data_tanggal = array();
        $data_pendapatan = array();

        while (strtotime($tanggal_awal) <= strtotime($tanggal_akhir)) {
            $data_tanggal[] = (int) substr($tanggal_awal, 8, 2);

            $revenue = Transaction::where('created_at', 'LIKE', "%$tanggal_awal%")->sum('total_price'); 
           
            $pengeluaran = Pengeluaran::where('tanggal_bayar', 'LIKE', "%$tanggal_awal%")->sum('total'); 
            
            $total_revenue += $revenue;
           
            $total_pengeluaran += $pengeluaran;

            $laba_rugi = $revenue - $pengeluaran;
            $total_laba_rugi += $laba_rugi;

            $tanggal_awal = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_awal)));
        }

        $tanggal_awal = date('Y-m-01');

        return view('dashboard', compact('transaction','supplier','product','total_revenue',
        'total_pengeluaran','revenuetoday', 'total_laba_rugi','labels', 'totals'));
    }
}
