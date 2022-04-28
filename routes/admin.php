<?php
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Admin\HomeController::class,'index'])->name('admin.index');
Route::get('/getProducts', [\App\Http\Controllers\Admin\HomeController::class,'getProducts']);
Route::get('/apiPython', [\App\Http\Controllers\Admin\HomeController::class,'getClient'])->name('admin.apiPython');
Route::resource('admin/product', \App\Http\Controllers\productController::class)->names('admin.product');
Route::resource('admin/client', \App\Http\Controllers\productController::class)->names('admin.client');
