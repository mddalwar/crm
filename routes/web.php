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
Route::get('/admin/settings', [App\Http\Controllers\HomeController::class, 'settings'])->middleware(['auth'])->name('settings');
Route::post('/admin/settings', [App\Http\Controllers\HomeController::class, 'setting_change'])->middleware(['auth'])->name('settings.update');

Route::group(
	[
		'prefix'		=> 'admin',
		'middleware'	=> ['auth']
	], 
	function(){
		Route::resource('users', 'App\Http\Controllers\UserController');
		Route::resource('customers', 'App\Http\Controllers\CustomerController');
		Route::resource('products', 'App\Http\Controllers\ProductController');
		Route::resource('invoices', 'App\Http\Controllers\InvoiceController');
	}
);