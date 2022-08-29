<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Resources\AccountResource;
use App\Services\AccountService;

class AccountController extends Controller
{
    public function index(AccountService $accountService)
    {
        $account = $accountService->getAll();

        return ResponseFormatter::success('Account fetched', AccountResource::collection($account));
    }

    public function show(AccountService $accountService, $id)
    {
        $account = $accountService->show($id);

        if (is_null($account)) {
            return ResponseFormatter::error('Account not found', null, 404);
        }

        return ResponseFormatter::success('Account found', new AccountResource($account));
    }

    public function store(StoreAccountRequest $request, AccountService $accountService)
    {
        $account = $accountService->create($request);

        return ResponseFormatter::success('Account created successfully', new AccountResource($account), 201);
    }

    public function update(UpdateAccountRequest $request, AccountService $accountService, $id)
    {
        // find account
        $account = $accountService->show($id);

        if (is_null($account))
            return ResponseFormatter::error('Account not found', null, 404);

        // update account
        $account = $accountService->update($account, $request);

        return ResponseFormatter::success('Account updated successfully', new AccountResource($account));
    }

    public function destroy(AccountService $accountService, $id)
    {
        // find account
        $account = $accountService->show($id);

        // check account
        if (is_null($account))
            return ResponseFormatter::error('Account not found', null, 404);

        // destroy account
        $account = $accountService->destroy($account);

        return ResponseFormatter::success('Account deleted successfully');
    }
}
