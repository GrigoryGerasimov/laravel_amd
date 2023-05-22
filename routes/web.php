<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::controller(HomeController::class)->group(function() {
    Route::get('/home', 'index')->name('home');
    Route::get('/protected', 'showProtected')->name('protected')->middleware('can:approve');
});


