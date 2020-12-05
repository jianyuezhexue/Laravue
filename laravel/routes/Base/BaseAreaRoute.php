<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Base')->group(function () {
    /** BaseArea管理 */
    Route::group(['prefix' => 'baseArea', 'middleware' => ['auth.jwt']], function () {
        Route::get('/', 'BaseAreaController@all');
        Route::get('/find/{id}', 'BaseAreaController@find');
        Route::get('/list', 'BaseAreaController@list');
        Route::post('/', 'BaseAreaController@create');
        Route::put('/{id}', 'BaseAreaController@update');
        Route::delete('/{id}', 'BaseAreaController@destroy');
    });
});
