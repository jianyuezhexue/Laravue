<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\{{nameSpace}}')->group(function () {
    /** {{Template}}管理 */
    Route::group(['prefix' => '{{Template}}', 'middleware' => ['auth.jwt']], function () {
        Route::get('/', '{{Template}}Controller@all');
        Route::get('/find/{id}', '{{Template}}Controller@find');
        Route::get('/list', '{{Template}}Controller@list');
        Route::post('/', '{{Template}}Controller@create');
        Route::put('/{id}', '{{Template}}Controller@update');
        Route::delete('/{id}', '{{Template}}Controller@destroy');
    });
});
