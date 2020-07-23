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

Route::POST('createUser', 'User@createUser');

Route::POST('createRepublic', 'RepublicController@createRepublic');
Route::GET('showRepublic/{id}', 'RepublicController@showRepublic');
Route::GET('listRepublic', 'RepublicController@listRepublic');
Route::PUT('updateRepublic', 'RepublicController@updateRepublic');
Route::DELETE('deleteRepublic/{id}', 'RepublicController@deleteRepublic');
Route::PUT('addRepublic/{id}', 'RepublicController@addRepublic');
Route::PUT('removeRepublic/{id}', 'RepublicController@removeRepublic');