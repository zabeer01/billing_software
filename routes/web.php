<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\BillController;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//customers
Route::resource('customers', CustomerController::class);

//websites
Route::resource('websites', WebsiteController::class);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/bills/pay-ajax', [BillController::class, 'payAjax'])->name('bills.payAjax');
Route::get('/bills/invoice',[BillController::class, 'invoiceGenerate'])->name('bills.invoice');
Route::resource('bills', BillController::class);

