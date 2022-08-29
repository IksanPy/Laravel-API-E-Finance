<?php

use App\Http\Controllers\API\AccountController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CashRecapController;
use App\Http\Controllers\API\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', function () {
        return auth()->user();
    });

    Route::apiResource('accounts', AccountController::class);
    Route::apiResource('recaps', CashRecapController::class)->except('destroy');
    Route::apiResource('transactions', TransactionController::class);

    Route::post('logout', [AuthController::class, 'logout']);
});
