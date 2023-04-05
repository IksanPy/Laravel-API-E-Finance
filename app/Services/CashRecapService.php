<?php

namespace App\Services;

use App\Models\CashRecap;
use Illuminate\Support\Facades\Auth;

class CashRecapService
{
    public function getAll()
    {
        $cashRecap = CashRecap::all();

        return $cashRecap;
    }

    public function show($yearMonth)
    {
        // attr
        $yearMonth = explode('-', $yearMonth);
        $year = $yearMonth[0];
        $month = $yearMonth[1];

        $cashRecap = CashRecap::whereYear('year_month', $year)
            ->whereMonth('year_month', $month)
            ->first();

        return $cashRecap;
    }

    public function create($yearMonth)
    {
        $cashRecap = CashRecap::create([
            'user_id' => Auth::id(),
            'year_month' => $yearMonth . '-01',
            'balance' => 0
        ]);

        return $cashRecap;
    }

    public function updateBalance($cashRecap, $request, $return = false)
    {
        $beginingBalance = $cashRecap->balance;

        if ($return) :
            $newBalance = [
                'debit' => $beginingBalance - $request['nominal'],
                'credit' => $beginingBalance + $request['nominal']
            ];
        else :
            $newBalance = [
                'credit' => $beginingBalance - $request['nominal'],
                'debit' => $beginingBalance + $request['nominal']
            ];
        endif;

        $cashRecap->balance = $newBalance[$request['type']];
        $cashRecap->save();

        return $cashRecap;
    }

    public function destroy($cashRecap, $id)
    {
        $cashRecap->delete($id);

        return $cashRecap;
    }
}
