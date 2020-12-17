<?php

use Illuminate\Support\Facades\Route;


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

Route::get('/', ['as' => 'user.login.page', 'uses' => 'Controller@login']);
Route::post('/', ['as' => 'user.login', 'uses' => 'DashboardController@auth']);

Route::get('/dashboard', ['as' => 'user.dashboard', 'uses'=> 'DashboardController@index']);
Route::get('/logout', ['as' => 'user.logout', 'uses' => 'DashboardController@logout']);
Route::get('/user', ['as' => 'user.users', 'uses' => 'UsersController@index']);

