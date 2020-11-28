<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| 1.系统相关
|--------------------------------------------------------------------------
|
| 系统相关：用户管理，菜单（路由）管理，角色管理，权限管理，自动化代码
| 用户管理：注册/登录/修改密码/设置用户权限/删除用户/设置用户角色/分页获取用户列表
| 菜单管理：
| 角色管理：
|
*/
Route::namespace('App\Http\Controllers\System')->group(function () {
    /** 用户管理 */
    Route::group(['prefix' => 'user'], function () {
        Route::post('register', 'UserController@register');
        Route::post('login', 'UserController@login');
        Route::group(['middleware' => ['auth.jwt']], function () {
            Route::put('setAuthority/{uuid}', 'UserController@setAuthority');
            Route::post('list', 'UserController@userList');
            Route::post('loginOut', 'UserController@loginOut');
            Route::delete('/{id}', 'UserController@destroy');
        });
    });
    /** 菜单管理 */
    Route::group(['prefix' => 'menu', 'middleware' => ['auth.jwt']], function () {
        Route::get('/', 'MenuController@all');
        Route::get('/async', 'MenuController@async');
        Route::get('/find/{id}', 'MenuController@find');
        Route::get('/list', 'MenuController@list');
        Route::post('/', 'MenuController@create');
        Route::put('/{id}', 'MenuController@update');
        Route::delete('/{id}', 'MenuController@destroy');
    });
    /** 角色管理 */
    Route::group(['prefix' => 'authority', 'middleware' => ['auth.jwt']], function () {
        Route::get('/', 'AuthorityController@all');
        Route::get('/find/{id}', 'AuthorityController@find');
        Route::get('/list', 'AuthorityController@list');
        Route::post('/', 'AuthorityController@create');
        Route::put('/{id}', 'AuthorityController@update');
        Route::delete('/{id}', 'AuthorityController@destroy');
    });
    /** 数据字典 */
    Route::group(['prefix' => 'dictionary', 'middleware' => ['auth.jwt']], function () {
        Route::get('/', 'DictionaryController@all');
        Route::get('/find/{id}', 'DictionaryController@find');
        Route::get('/list', 'DictionaryController@list');
        Route::post('/', 'DictionaryController@create');
        Route::put('/{id}', 'DictionaryController@update');
        Route::delete('/{id}', 'DictionaryController@destroy');
    });
    /** 数据字典详情 */
    Route::group(['prefix' => 'dictionaryDetail', 'middleware' => ['auth.jwt']], function () {
        Route::get('/', 'DictionaryDetailController@all');
        Route::get('/find/{id}', 'DictionaryDetailController@find');
        Route::get('/list', 'DictionaryDetailController@list');
        Route::post('/', 'DictionaryDetailController@create');
        Route::put('/{id}', 'DictionaryDetailController@update');
        Route::delete('/{id}', 'DictionaryDetailController@destroy');
    });
    /** 操作日志 */
    Route::group(['prefix' => 'accessLog', 'middleware' => ['auth.jwt']], function () {
        Route::get('/list', 'AccessLogController@list');
        Route::delete('/{id}', 'AccessLogController@destroy');
    });
    /** 自动化代码 */
    Route::group(['prefix' => 'autoCode', 'middleware' => ['auth.jwt']], function () {
        Route::get('/getDB', 'AutoCodeController@getDB');
        Route::get('/getTables', 'AutoCodeController@getTables');
        Route::get('/getColume', 'AutoCodeController@getColume');
        Route::post('/', 'AutoCodeController@autoCode');
    });
    /** 文件管理 */
    Route::group(['prefix' => 'file', 'middleware' => ['auth.jwt']], function () {
        Route::get('/', 'FileController@all');
        Route::get('/find/{id}', 'FileController@find');
        Route::get('/list', 'FileController@list');
        Route::post('/', 'FileController@create');
        Route::put('/{id}', 'FileController@update');
        Route::delete('/{id}', 'FileController@destroy');
    });
});

/** 2.基础数据 */
Route::namespace('Base')->group(function () {
});

/** 3.业务相关 */
Route::namespace('App\Http\Controllers\Business')->group(function () {
    /** DEMO文章管理 */
    Route::group(['prefix' => 'busArticle', 'middleware' => ['auth.jwt']], function () {
        Route::get('/', 'BusArticleController@all');
        Route::get('/find/{id}', 'BusArticleController@find');
        Route::get('/list', 'BusArticleController@list');
        Route::post('/', 'BusArticleController@create');
        Route::put('/{id}', 'BusArticleController@update');
        Route::delete('/{id}', 'BusArticleController@destroy');
    });
});
