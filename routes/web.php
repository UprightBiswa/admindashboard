<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\QuotationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);


    //customer route
    Route::controller(ClientsController::class)->group(function () {
        Route::get('/customers', 'index');
        Route::get('/customers/create', 'create');
        Route::post('/customers', 'store');
        Route::get('/customers/{customer}', 'show');
        Route::get('/customers/{customer}/edit', 'edit');
        Route::put('/customers/{customer}', 'update');
        Route::delete('/customers/{customer}', 'destroy');
    });


    //service route
    Route::controller(ServiceController::class)->group(function () {
        Route::get('/services', 'index');
        Route::get('/services/create', 'create');
        Route::post('/services', 'store');
        Route::get('/services/{service}', 'show');
        Route::get('/services/{service}/edit', 'edit');
        Route::put('/services/{service}', 'update');
        Route::delete('/services/{service}', 'destroy');
    });

    //quotation route
    Route::controller(QuotationController::class)->group(function () {
        Route::get('/quotations', 'index');
        Route::get('/quotations/create', 'create');
        Route::post('/quotations', 'store');
        Route::get('/quotations/{quotation}', 'show');
        Route::get('/quotations/{quotation}/edit', 'edit');
        Route::put('/quotations/{quotation}', 'update');
        Route::delete('/quotations/{quotation}', 'destroy');
        Route::get('/quotations/pdf/{quotation}', 'pdf');
    });

    //invoice route
    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/invoices', 'index');
        Route::get('/invoices/create', 'create');
        Route::post('/invoices', 'store');
        Route::get('/invoices/{invoice}', 'show');
        Route::get('/invoices/{invoice}/edit', 'edit');
        Route::put('/invoices/{invoice}', 'update');
        Route::delete('/invoices/{invoice}', 'destroy');
        Route::get('/invoices/pdf/{invoice}', 'pdf');

        // Route::get('invoices/{invoice}', 'create');
        Route::post('invoices/{invoice}/payment', 'submitPayment');
    });
});
