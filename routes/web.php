<?php

use App\Http\Controllers\Admin\DashboardController;
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


