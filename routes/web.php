<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes([
	'register'		=> false
]);


Route::get('/', [App\Http\Controllers\HomeController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');






Route::group(
	[
		'prefix'		=> 'admin',
		'middleware'	=> ['auth']
	], 
	function(){
		// Settings Route
		Route::get('/settings', [App\Http\Controllers\HomeController::class, 'settings'])->name('settings');
		Route::post('/settings', [App\Http\Controllers\HomeController::class, 'setting_change'])->name('settings.update');

		// Stock Add Route
		Route::get('/addstock', [App\Http\Controllers\HomeController::class, 'addstock'])->name('addstock');
		Route::post('/addstock', [App\Http\Controllers\HomeController::class, 'stockstore'])->name('addstock.store');

		// Due Route
		Route::get('/dues', [App\Http\Controllers\HomeController::class, 'dues'])->name('dues');

		// Pdf Download Routes
		Route::get('/invoicedownload', [App\Http\Controllers\PdfController::class, 'invoicedownload']);

		// Resource Routes
		Route::resource('users', 'App\Http\Controllers\UserController');
		Route::resource('customers', 'App\Http\Controllers\CustomerController');
		Route::resource('products', 'App\Http\Controllers\ProductController');
		Route::resource('invoices', 'App\Http\Controllers\InvoiceController');
		Route::resource('expenses', 'App\Http\Controllers\ExpenseController');
	}
);