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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::resource('product', App\Http\Controllers\productController::class);


Route::resource('size', App\Http\Controllers\SizeController::class);

Route::resource('region', App\Http\Controllers\RegionController::class);

Route::resource('province', App\Http\Controllers\ProvinceController::class);

Route::resource('municipality', App\Http\Controllers\MunicipalityController::class);

Route::resource('address', App\Http\Controllers\AddressController::class);

Route::resource('status', App\Http\Controllers\StatusController::class);

Route::resource('category-type', App\Http\Controllers\CategoryTypeController::class);

Route::resource('category', App\Http\Controllers\CategoryController::class);

Route::resource('point-of-sale', App\Http\Controllers\PointOfSaleController::class);

Route::resource('phone', App\Http\Controllers\PhoneController::class);

Route::resource('email', App\Http\Controllers\EmailController::class);

Route::resource('client', App\Http\Controllers\ClientController::class);

Route::resource('sale', App\Http\Controllers\SaleController::class);

Route::resource('sales-detail', App\Http\Controllers\SalesDetailController::class);

Route::resource('producto', App\Http\Controllers\ProductoController::class);

Route::resource('inventory', App\Http\Controllers\InventoryController::class);

Route::resource('inventory-detail', App\Http\Controllers\InventoryDetailController::class);


Route::resource('brand', App\Http\Controllers\BrandController::class);
