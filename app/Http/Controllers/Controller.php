<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     title="E-Finance",
 *     version="1.0.0",
 *     description="E-Finance adalah API untuk memanajemen transaksi pemasukan dan pengeluaran ditujukan agar semua anda transaksi terdata supaya anda-anda tahu uang anda habis untuk apa."
 * )
 *
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function responseJson()
    {
        return response()->json(['good']);
    }
}
