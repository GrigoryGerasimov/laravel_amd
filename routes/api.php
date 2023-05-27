<?php

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller('App\Http\Controllers\Auth\AuthController')->middleware('api')->prefix('auth')->group(function() {
    Route::post('login', 'login');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('user', 'user');
});

Route::group(['namespace' => 'App\Http\Controllers\Article'], function() {
    Route::group(['namespace' => 'Api'], function() {
        Route::get('articles', 'IndexController')->name('api.amd.index');
        Route::post('articles', 'StoreController')->name('api.amd.store');
        Route::get('/articles/{article}', 'ShowController')->name('api.amd.show');
        Route::patch('/articles/{article}', 'UpdateController')->name('api.amd.update');
        Route::delete('/articles/{article}', 'DestroyController')->name('api.amd.destroy');
        Route::get('/articles/{article:id}/restore', 'RestoreController')->name('api.amd.restore');
    });
});
