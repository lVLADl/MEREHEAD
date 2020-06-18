<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Facades\JWTAuth;

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

Route::get('authors/', 'AuthorController@index');

Route::get('books/', 'BookController@index');
Route::get('books/{author}', 'BookController@author_books');



Route::group(['middleware' => ['jwt.verify'], 'prefix' => 'books'], function() {
    # TODO Route::get('user_books/', );
    Route::post('create/', 'BookController@store');

    /* Route::get('hux/', function(Request $request) {
            return $user = JWTAuth::parseToken()->authenticate();
        return response()->json(\Illuminate\Support\Facades\Auth::user());
    }); */
});

Route::prefix('auth')->group(function() {
    Route::post('register/', 'AuthController@register');
    Route::post('login/', 'AuthController@authenticate');

    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::get('user/', 'AuthController@getAuthenticatedUser');
    });
});
