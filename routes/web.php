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
		Route::get('/settings', [App\Http\Controllers\SettingController::class, 'settings'])->name('settings');
		Route::post('/settings', [App\Http\Controllers\SettingController::class, 'setting_change'])->name('settings.update');

		// Report Route
		Route::get('/reports/currentday', [App\Http\Controllers\SettingController::class, 'currentday'])->name('currentDayReport');

		// Due Route
		Route::get('/dues', [App\Http\Controllers\SettingController::class, 'dues'])->name('dues');

		// Pdf Download Routes
		Route::get('/download/invoice/{id}', [App\Http\Controllers\PdfController::class, 'invoice'])->name('invoicedownload');
		Route::get('/download/collection/{id}', [App\Http\Controllers\PdfController::class, 'collection'])->name('collectiondownload');

		// Ajax Products
		Route::get('/ajaxproducts', [App\Http\Controllers\ProductController::class, 'ajaxproducts'])->name('ajaxproducts');

		// Pdf Download Routes
		Route::get('/product/export', [App\Http\Controllers\ProductController::class, 'export'])->name('productExport');

		// Resource Routes
		Route::resource('roles', 'App\Http\Controllers\RoleController');
		Route::resource('users', 'App\Http\Controllers\UserController');
		Route::resource('customers', 'App\Http\Controllers\CustomerController');
		Route::resource('products', 'App\Http\Controllers\ProductController');
		Route::resource('categories', 'App\Http\Controllers\CategoryController');
		Route::resource('invoices', 'App\Http\Controllers\InvoiceController');
		Route::resource('expenses', 'App\Http\Controllers\ExpenseController');
		Route::resource('invests', 'App\Http\Controllers\InvestController');
		Route::resource('stocks', 'App\Http\Controllers\StockController');
		Route::resource('collections', 'App\Http\Controllers\CollectionController');
	}
);