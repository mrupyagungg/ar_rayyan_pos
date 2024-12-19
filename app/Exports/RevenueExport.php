<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RevenueReportExport implements FromView
{
    protected $start, $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function view(): View
    {
        // Ambil data laporan
        $reports = Revenue::whereBetween('date', [$this->start, $this->end])->get();

        $total_revenue = $reports->sum('revenue');

        return view('exports.revenue_report', [
            'reports' => $reports,
            'total_revenue' => $total_revenue
        ]);
    }
}
