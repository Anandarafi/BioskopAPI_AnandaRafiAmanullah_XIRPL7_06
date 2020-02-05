<?php

use Illuminate\Http\Request;

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
|-----------------------------------------------------------------------|
|                         LOGIN PETUGAS BIOSKOP                         |
|-----------------------------------------------------------------------|
*/
Route::post('login','UserController@login');
Route::get('/login/check', 'UserController@getAuthenticatedUser');//->middleware('jwt.verify');

/*
|-----------------------------------------------------------------------|
|                       CRUD PETUGAS BIOSKOP                            | 
|-----------------------------------------------------------------------|
*/
Route::post('petugas','UserController@register');
Route::put('petugas/{id}','UserController@update');
Route::delete('petugas/{id}','UserController@delete');
Route::get('petugas','UserController@tampil');

/*
|-----------------------------------------------------------------------|
|                              CRUD STUDIO                              | - DONE
|-----------------------------------------------------------------------|
*/
Route::post('studio','StudioController@store');//->middleware('jwt.verify');
Route::put('studio/{id}','StudioController@update');//->middleware('jwt.verify');
Route::delete('studio/{id}','StudioController@delete');//->middleware('jwt.verify');
Route::get('studio','StudioController@tampil');//->middleware('jwt.verify');

/*
|-----------------------------------------------------------------------|
|                                CRUD FILM                              | - DONE
|-----------------------------------------------------------------------|
*/
Route::post('film','FilmController@store');//->middleware('jwt.verify');
Route::put('film/{id}','FilmController@update');//->middleware('jwt.verify');
Route::delete('film/{id}','FilmController@delete');//->middleware('jwt.verify');
Route::get('film','FilmController@tampil');//->middleware('jwt.verify');

/*
|-----------------------------------------------------------------------|
|                            CRUD TAYANG                                | - DONE
|-----------------------------------------------------------------------|
*/
Route::post('tayang','TayangController@store');//->middleware('jwt.verify');
Route::put('tayang/{id}','TayangController@update');//->middleware('jwt.verify');
Route::delete('tayang/{id}','TayangController@delete');//->middleware('jwt.verify');
Route::get('tayang/{id}','TayangController@tampil');//->middleware('jwt.verify');

/*
|-----------------------------------------------------------------------|
|                            CRUD TIKET                                 |
|-----------------------------------------------------------------------|
*/
Route::post('tiket','TiketController@store');//->middleware('jwt.verify');
Route::put('tiket/{id}','TiketController@update');//->middleware('jwt.verify');
Route::delete('tiket/{id}','TiketController@delete');//->middleware('jwt.verify');
Route::get('tiket/{id}/{id1}','TiketController@tampil');//->middleware('jwt.verify');