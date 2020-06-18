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

Route::get('test/', function(Request $request) {
    $user = \Illuminate\Support\Facades\Auth::user();
    return $user->author;
});


Route::get('authors/', 'AuthorController@index');

Route::get('books/', 'BookController@index');
Route::get('books/by_author/{author}/', 'BookController@author_books');
Route::get('books/{book_id}/', 'BookController@show');

Route::get('my_books/', 'BookController@get_auth_user_books')->middleware(['jwt.verify']);

Route::group(['middleware' => ['jwt.verify'], 'prefix' => 'books'], function() {
    Route::post('', 'BookController@store');

    Route::group(['middleware' => ['check_book_rights']], function() {
        Route::put('{book_id}/', 'BookController@update');
        Route::delete('{book_id}/', 'BookController@destroy');
    });
});

Route::prefix('auth')->group(function() {
    Route::post('register/', 'AuthController@register');
    Route::post('login/', 'AuthController@authenticate');

    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::get('user/', 'AuthController@getAuthenticatedUser');
    });
});
