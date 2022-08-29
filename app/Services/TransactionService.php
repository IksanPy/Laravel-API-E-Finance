<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionService
{
    public function getAll()
    {
        $transaction = Transaction::latest()->get();

        return $transaction;
    }

    public function show($id)
    {
        $transaction = Transaction::with(['account', 'cash_recap'])->find($id);

        return $transaction;
    }

    public function create($request)
    {
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'account_id' => $request['account_id'],
            'cash_recap_id' => $request['cash_recap_id'],
            'date' => $request['date'],
            'nominal' => $request['nominal'],
            'description' => $request['description']
        ]);

        return $transaction;
    }

    public function update($transaction, $request)
    {
        $transaction->account_id = $request['account_id'];
        $transaction->cash_recap_id = $request['cash_recap_id'];
        $transaction->date = $request['date'];
        $transaction->nominal = $request['nominal'];
        $transaction->description = $request['description'];
        $transaction->save();

        return $transaction;
    }

    public function destroy($transaction)
    {
        $transaction->delete();

        return $transaction;
    }
}
