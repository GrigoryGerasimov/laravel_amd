<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::controller(HomeController::class)->group(function() {
    Route::get('/home', 'index')->name('home');
    Route::get('/protected', 'showProtected')->name('protected')->middleware('can:manage');
});

Route::group(['namespace' => 'App\Http\Controllers\Article\Web'], function() {
    Route::get('/articles', 'IndexController')->name('amd.index');
    Route::get('/articles/{article}', 'ShowController')->name('amd.show');

    Route::middleware('can:create')->group(function() {
        Route::get('/articles/create', 'CreateController')->name('amd.create');
        Route::post('/articles', 'StoreController')->name('amd.store');
    });

    Route::middleware('can:manage')->group(function() {
       Route::get('/articles/{article}', 'EditController')->name('amd.edit');
       Route::patch('/articles/{article}', 'UpdateController')->name('amd.update');
       Route::delete('/articles/{article}', 'DestroyController')->name('amd.destroy');
    });
});


