<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('test', function () {
    // return view('welcome');
// });

/**
 *测试路由
 */
Route::group(['middleware' => [], 'namespace' => 'Test'], function () {
    Route::get('test', 'TestController@index');
});
