<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserPermission;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware([CheckUserPermission::class . ':kullanici_ekleme'])->group(function () {
    Route::resource('users', UserController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
