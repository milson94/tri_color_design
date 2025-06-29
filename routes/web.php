<?php

use App\Http\Controllers\MpesaPaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/mpesa-form', [MpesaPaymentController::class, 'showForm']);
Route::post('/mpesa/pay', [MpesaPaymentController::class, 'pay'])->name('mpesa.pay');
