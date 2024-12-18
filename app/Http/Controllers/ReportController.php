<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Exports\RevenueExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
class ReportController extends Controller
{
    public function revenue(Request $request)
	{
		$startDate = $request->input('start');
        $endDate = $request->input('end');

		if ($startDate && !$endDate) {
			return redirect('reports/revenue');
		}

		if (!$startDate && $endDate) {
			return redirect('reports/revenue');
		}

		if ($startDate && $endDate) {
			if (strtotime($endDate) < strtotime($startDate)) {
				return redirect('reports/revenue');
			}

			$earlier = new \DateTime($startDate);
			$later = new \DateTime($endDate);
			$diff = $later->diff($earlier)->format("%a");
			
			if ($diff >= 31) {
				return redirect('reports/revenue');
			}
		} else {
			$currentDate = date('Y-m-d');
			$startDate = date('Y-m-01', strtotime($currentDate));
			$endDate = date('Y-m-t', strtotime($currentDate));
		}
		$startDate = $startDate;
        $endDate = $endDate;

        $reports = [];
        $revenue = 0;
        $total_revenue = 0;

        while (strtotime($startDate) <= strtotime($endDate)) {
            $date = $startDate;
            $startDate = date('Y-m-d', strtotime("+1 day", strtotime($startDate)));

            $revenue = Transaction::where('created_at', 'LIKE', "%$date%")->sum('total_price'); 

            $total_revenue += $revenue;

            $row = [];
            $row['date'] = $date;
            $row['revenue'] = $revenue;
            $reports[] = $row;
		}
		
		if ($exportAs = $request->input('export')) {
			if (!in_array($exportAs, ['xlsx', 'pdf'])) {
				return redirect()->route('reports.revenue');
			}

			if ($exportAs == 'xlsx') {
				$fileName = 'report-revenue_'. $startDate .'_'. $endDate .'.xlsx';

				return Excel::download(new RevenueExport($reports, $total_revenue), $fileName);
			}

			if ($exportAs == 'pdf') {
				$startDate = $request->input('start');
				$fileName = 'report-revenue_'. $startDate .'_'. $endDate .'.pdf';
				$pdf = PDF::loadView('reports.exports.revenue-pdf', compact('reports','total_revenue','startDate','endDate'));

				return $pdf->download($fileName);
			}
        }

        // dd($reports);

		return view('reports.revenue', compact('reports','total_revenue','startDate','endDate'));
	}
}
