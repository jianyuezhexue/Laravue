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
| 系统相关：包含用户管理，菜单（路由）管理，角色管理，权限管理，
| 用户管理：注册/登录/修改密码/设置用户权限/删除用户/设置用户信息/分页获取用户列表
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::namespace('App\Http\Controllers\System')->group(function () {
    /** 用户管理 */
    Route::group(['prefix' => 'user'], function () {
        Route::post('register', 'UserController@register');
        Route::post('login', 'UserController@login');
        Route::group(['middleware' => ['auth.jwt']], function () {
            Route::get('list', 'UserController@userList');
            Route::post('loginOut', 'UserController@loginOut');
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
});

/** 2.基础数据 */
Route::namespace('Base')->group(function () {
});

/** 3.业务相关 */
