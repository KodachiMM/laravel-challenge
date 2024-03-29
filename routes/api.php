<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InternetServiceProviderController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StaffController;
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

Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('posts', [PostController::class, 'index']);
    Route::post('posts/{post}/reaction', [PostController::class, 'toggleReaction']);

    Route::post('mpt/invoice-amount', [InternetServiceProviderController::class, 'getMptInvoiceAmount']);
    Route::post('ooredoo/invoice-amount', [InternetServiceProviderController::class, 'getOoredooInvoiceAmount']);

    Route::post('jobs/{job}/apply', [JobController::class, 'apply']);
    Route::post('jobs/{job}/users/{user}', [JobController::class, 'hire']);

    Route::get('payrolls', [PayrollController::class, 'index']);
    Route::post('staff/{staff}/payroll', [StaffController::class, 'payroll']);
});
