<?php

namespace App\Services;

use App\Models\Transaction;

class ReportService
{
    public function dateRangeWithType($start_date, $end_date, $type = false)
    {
        // jika tanggal transaksi lebih besar dari start date
        // dan 
        // tanggal transaksi lebih kecil dari end date
        $transaction = Transaction::whereDate('date', '>=', $start_date)
            ->whereDate('date', '<=', $end_date)
            ->accountType($type)
            ->get();

        return $transaction;
    }

    public function yearMonthWithType($year_month, $type = false)
    {
        $year_month = explode('-', $year_month);
        $year = $year_month[0];
        $month = $year_month[1];

        $transaction = Transaction::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->accountType($type)
            ->get();

        return $transaction;
    }
}
