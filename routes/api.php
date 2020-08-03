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

Route::POST('createUser', 'UserController@createUser');
Route::GET('showUser/{id}', 'UserController@showUser');
Route::GET('listUser', 'UserController@listUser');
Route::PUT('updateUser/{id}', 'UserController@updateUser');
Route::DELETE('deleteUser/{id}', 'UserController@deleteUser');
Route::PUT('alugar/{user_id}/{republic_id}', 'UserController@alugar');
Route::DELETE('removeAluguel/{republic_id}/{user_id}', 'UserController@removeAluguel');
Route::PUT('favoritarRep/{user_id}/{republic_id}', 'UserController@favoritarRep');
Route::PUT('desfavoritarRep/{user_id}/{republic_id}', 'UserController@desfavoritarRep');
Route::GET('listFavRep/{id}', 'UserController@listFavRep');

Route::POST('createRepublic', 'RepublicController@createRepublic');
Route::GET('showRepublic/{id}', 'RepublicController@showRepublic');
Route::GET('listRepublic', 'RepublicController@listRepublic');
Route::PUT('updateRepublic/{id}', 'RepublicController@updateRepublic');
Route::POST('searchRepublic','RepublicController@searchRepublic');
Route::PUT('addRepublic/{user_id}/{republic_id}', 'RepublicController@addRepublic');
Route::PUT('removeRepublic/{user-id}/{republic_id}', 'RepublicController@removeRepublic');
Route::GET('locatarios/{id}', 'RepublicController@locatarios');
Route::GET('mostrarProprietario/{id}', 'RepublicController@mostrarProprietario');
Route::PUT('republicasDeletadas', 'RepublicController@republicasDeletadas');
Route::PUT('restoreOneRepublic/{id}', 'RepublicController@restoreOneRepublic');
Route::PUT('restoreRepublics', 'RepublicController@restoreRepublics');
Route::POST('countUserRepublics', 'RepublicController@countUserRepublics');

//Passport Routes
Route::post('register', 'API\PassportController@register');
Route::post('login', 'API\PassportController@login');
Route::group(['middleware' => 'auth:api'], function() {
	Route::DELETE('deleteRepublic/{id}', 'RepublicController@deleteRepublic')->middleware('DeleteRepublic');
	Route::post('logout', 'API\PassportController@logout');
	Route::post('getDetails', 'API\PassportController@getDetails');
});