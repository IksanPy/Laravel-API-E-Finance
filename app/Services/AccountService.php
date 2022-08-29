<?php

namespace App\Services;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class AccountService
{
    public function getAll()
    {
        $account = Account::get();

        return $account;
    }

    public function show($id)
    {
        $account = Account::find($id);

        return $account;
    }

    public function create($request)
    {
        $account = Account::create([
            'user_id' => Auth::id(),
            'name' => $request['name'],
            'type' => $request['type'],
        ]);

        return $account;
    }

    public function update($account, $request)
    {
        $account->name = $request['name'];
        $account->type = $request['type'];
        $account->save();

        return $account;
    }

    public function destroy($account)
    {
        $account->delete();

        return $account;
    }
}
