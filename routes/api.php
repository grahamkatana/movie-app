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

Route::get('movies','Api\Movies_V01\MovieController@index');
Route::get('movies/search/{query}','Api\Movies_V01\MovieController@search');
//Route::get('moviessearch','Api\Movies_V01\MovieController@search');
Route::get('movies/{id}','Api\Movies_V01\MovieController@show');
