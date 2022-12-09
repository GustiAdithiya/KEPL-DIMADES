<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EdibleProductController;
use App\Http\Controllers\Admin\InedibleProductController;
use App\Http\Controllers\Admin\MitraController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// --ROUTE PENGUNJUNG--
Route::get('/', function(){
    return view('welcome');
});

// --ROUTE DASHBOARD--
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::resource('admin/mitra', MitraController::class)->middleware('auth')->names('mitra');
Route::resource('admin/category', CategoryController::class)->middleware('auth')->names('category');
Route::resource('admin/food', EdibleProductController::class)->middleware('auth')->names('food');
Route::resource('admin/item', InedibleProductController::class)->middleware('auth')->names('item');


