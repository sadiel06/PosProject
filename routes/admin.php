<?php
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Admin\HomeController::class,'index'])->name('admin.index');
Route::resource('admin/product', \App\Http\Controllers\productController::class)->names('admin.product');
