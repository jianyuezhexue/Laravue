<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Business')->group(function () {
    /** BusArticle管理 */
    Route::group(['prefix' => 'busArticle', 'middleware' => ['auth.jwt']], function () {
        Route::get('/', 'BusArticleController@all');
        Route::get('/find/{id}', 'BusArticleController@find');
        Route::get('/list', 'BusArticleController@list');
        Route::post('/', 'BusArticleController@create');
        Route::put('/{id}', 'BusArticleController@update');
        Route::delete('/{id}', 'BusArticleController@destroy');
    });
});
