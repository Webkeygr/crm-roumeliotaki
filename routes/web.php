<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return redirect()->route('customers.index');
});

// Customers CRUD
Route::resource('customers', CustomerController::class);
