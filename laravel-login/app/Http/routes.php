<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});
*/





/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    /* 登录 */
    Route::get('users/login', 'Auth\AuthController@getLogin');
    Route::post('users/login', 'Auth\AuthController@postLogin');
    Route::get('users/logout', 'Auth\AuthController@getLogout');

    /* 注册 */
    Route::get('users/register', 'Auth\AuthController@getRegister');
    Route::post('users/register', 'Auth\AuthController@postRegister');


    /* Authenticated users */
    Route::group(['middleware' => 'auth'], function()
    {
        Route::get('users/dashboard', array('as'=>'dashboard', function()
        {
            return View('users.dashboard');
        }));
    });

});
