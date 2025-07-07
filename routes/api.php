<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SmsProxyController;

Route::prefix('sms')->group(function () {
    Route::get('getNumber', [SmsProxyController::class, 'getNumber']);
    Route::get('get-sms', [SmsProxyController::class, 'getSms']);
    Route::get('cancel-number', [SmsProxyController::class, 'cancelNumber']);
    Route::get('get-status', [SmsProxyController::class, 'getStatus']);
});
