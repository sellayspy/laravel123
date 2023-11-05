<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('dashboard',function(){
    return view('dashboard')
})->name('dashboard');

Route::resource('barangs',BarangController::class);

Route::resource('customers',CustomerController::class);
