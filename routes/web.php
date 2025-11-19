<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return redirect()->route('customers.index');
});

Route::resource('customers', CustomerController::class);
Route::resource('companies', CompanyController::class);
Route::resource('appointments', AppointmentController::class);
