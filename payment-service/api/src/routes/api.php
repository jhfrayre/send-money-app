<?php

use App\Http\Controllers\{
    AuthController,
    HelperController,
    TransactionController,
    UserController
};
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => ['api']
], function (Router $router) {
    Route::post('/login', [AuthController::class, 'login'])->name('login');

});

Route::group([
    'middleware' => ['auth:api']
], function (Router $router) {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/user', [UserController::class, 'userInfo'])->name('user');
    Route::get('/financial-institutions', [HelperController::class, 'institutions'])->name('financial-institutions');

    Route::get('/transaction-history', [TransactionController::class, 'userTransactionHistory'])->name('transaction-history');
    Route::post('/send-money', [TransactionController::class, 'sendMoneyToUser'])->name('send-money');
    Route::post('/bank-transfer', [TransactionController::class, 'bankTransfer'])->name('bank-transfer');
});
