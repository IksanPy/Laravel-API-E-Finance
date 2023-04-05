<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportDateRangeRequest;
use App\Http\Requests\ReportYearMonthRequest;
use App\Services\ReportService;

class ReportController extends Controller
{
    protected function reduceTransaction($transaction)
    {
        return $transaction->reduce(function ($akumulasi, $item) {
            if ($item->account->type  == 'debit') :
                return $akumulasi + $item->nominal;
            else :
                return $akumulasi - $item->nominal;
            endif;
        }, 0);
    }

    public function index(
        ReportDateRangeRequest $request,
        ReportService $reportService
    ) {
        // get request
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $type = $request->type;

        $data['filter'] = $request->all();

        $transaction = $reportService->dateRangeWithType($start_date, $end_date, $type);

        // mereduce / mengagregate menjadi 1 item saja(akumulasi) jika ada type
        $transaction_total = ($type) ? $transaction->sum('nominal')
            : $this->reduceTransaction($transaction);

        $data['data']['transaction'] = $transaction;
        $data['data']['transaction_total'] = $transaction_total;

        return ResponseFormatter::success('Report data', $data['data'], 200, $data['filter']);
    }

    public function yearMonth(
        ReportYearMonthRequest $request,
        ReportService $reportService
    ) {
        $year_month = $request->year_month;
        $type = $request->type;

        $data['filter'] = $request->all();

        $transaction = $reportService->yearMonthWithType($year_month, $type);

        // mereduce / mengagregate menjadi 1 item saja(akumulasi) jika ada type
        $transaction_total = ($type) ? $transaction->sum('nominal')
            : $this->reduceTransaction($transaction);

        $data['data']['transaction'] = $transaction;
        $data['data']['transaction_total'] = $transaction_total;

        return ResponseFormatter::success('Report data', $data['data'], 200, $data['filter']);
    }
}
