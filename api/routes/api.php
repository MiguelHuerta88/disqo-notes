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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
// login route
Route::post('login', 'Api\AuthController@postLogin')->name('post.login');
Route::get('login', 'Api\AuthController@login')->name('login');

Route::middleware('auth:api')->group(function() {
	// logout
	Route::get('logout', 'Api\AuthController@logout')->name('logout');

	// Notes section
	Route::get('notes', 'Api\NotesController@all');
	Route::post('note', 'Api\NotesController@create')->name('note.create');
	Route::get('/note/{notes}', 'Api\NotesController@view')->middleware('owner');
	//Route::post('note/{notes}/edit', 'Api\NotesController@update')->middleware('owner');
	Route::patch('note/{notes}', 'Api\NotesController@update')->middleware('owner');
	Route::delete('/note/{notes}', 'Api\NotesController@delete')->middleware('owner');
});
