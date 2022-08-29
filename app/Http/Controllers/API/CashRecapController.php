<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CashRecapService;

class CashRecapController extends Controller
{
    public function index(CashRecapService $cashRecapService)
    {
        $cashRecap = $cashRecapService->getAll();

        if (is_null($cashRecap))
            return ResponseFormatter::error('Cash recap not found', null, 404);

        return ResponseFormatter::success('Cash recap fetched', $cashRecap);
    }

    public function show(CashRecapService $cashRecapService, $yearMonth)
    {
        $cashRecap = $cashRecapService->show($yearMonth);

        if (is_null($cashRecap))
            return ResponseFormatter::error('Cash recap not found', null, 404);

        return ResponseFormatter::success('Cash recap found', $cashRecap);

        // echo date("m-Y", strtotime("-1 months"));
    }
}
