<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Services\AccountService;
use App\Services\CashRecapService;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    public function index(TransactionService $transactionService)
    {
        $transaction = $transactionService->getAll();

        return ResponseFormatter::success('Transaction fetched', $transaction);
    }

    public function store(
        TransactionService $transactionService,
        CashRecapService $cashRecapService,
        AccountService $accountService,
        StoreTransactionRequest $request
    ) {
        // attr
        $yearMonth = date('Y-m', strtotime($request['date']));

        // cek account type
        $account = $accountService->show($request['account_id']);

        // cek cash recap
        $cashRecap = $cashRecapService->show($yearMonth);
        // if is null
        if (is_null($cashRecap))
            // create cash recap
            $cashRecap = $cashRecapService->create($yearMonth);

        // create transaction
        $request['cash_recap_id'] = $cashRecap->id;
        $transaction = $transactionService->create($request);

        // update cash recap balance
        $cashRecapRequest = [
            'type' => $account->type,
            'nominal' => $request['nominal']
        ];

        $cashRecapService->updateBalance($cashRecap, $cashRecapRequest);

        return ResponseFormatter::success('Transaction successfully.', new TransactionResource($transaction));
    }

    public function update(
        TransactionService $transactionService,
        CashRecapService $cashRecapService,
        AccountService $accountService,
        StoreTransactionRequest $request,
        $id
    ) {
        // attr
        $yearMonth = date('Y-m', strtotime($request['date']));

        // get old transaction
        $oldTransaction = $transactionService->show($id);

        if (is_null($oldTransaction))
            return ResponseFormatter::error('Transaction not found', null, 404);

        // get old account
        $oldAccount = $accountService->show($oldTransaction->account->id);

        // get old cash recap
        $oldCashRecap = $cashRecapService->show($oldTransaction->cash_recap->year_month);

        // return balance
        $oldCashRecapRequest = [
            'type' => $oldAccount->type,
            'nominal' => $oldTransaction->nominal
        ];
        $cashRecapService->updateBalance($oldCashRecap, $oldCashRecapRequest, true);

        // === update

        // cek account type
        $account = $accountService->show($request['account_id']);

        // check cash recap
        $cashRecap = $cashRecapService->show($yearMonth);

        // if is null
        if (is_null($cashRecap))
            // create cash recap
            $cashRecap = $cashRecapService->create($yearMonth);

        // update transaction
        $request['cash_recap_id'] = $cashRecap->id;
        $transaction = $transactionService->update($oldTransaction, $request);

        // update cash recap balance
        $cashRecapRequest = [
            'type' => $account->type,
            'nominal' => $request['nominal']
        ];

        $cashRecapService->updateBalance($cashRecap, $cashRecapRequest);

        return ResponseFormatter::success('Transaction updated successfully.', new TransactionResource($transaction));
    }

    public function destroy(
        TransactionService $transactionService,
        AccountService $accountService,
        CashRecapService $cashRecapService,
        $id
    ) {

        // find transaction
        $transaction = $transactionService->show($id);

        if (is_null($transaction))
            return ResponseFormatter::error('Transaction not found', null, 404);

        // get old account
        $oldAccount = $accountService->show($transaction->account->id);

        // get old cash recap
        $oldCashRecap = $cashRecapService->show($transaction->cash_recap->year_month);

        // return balance
        $oldCashRecapRequest = [
            'type' => $oldAccount->type,
            'nominal' => $transaction->nominal
        ];
        $cashRecapService->updateBalance($oldCashRecap, $oldCashRecapRequest, true);

        // check transaction
        if (is_null($transaction))
            return ResponseFormatter::error('Transaction not found', null, 404);

        // destroy transaction
        $transactionService->destroy($transaction);

        return ResponseFormatter::success('Transaction deleted successfully');
    }
}
