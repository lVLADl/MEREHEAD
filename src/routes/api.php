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

Route::get('authors/' /*TODO*/);

Route::get('books/' /*TODO*/);
Route::get('books/{author}' /*TODO*/);

Route::middleware(['jwt.verify'])->prefix('')->group(function() {

});

Route::prefix('auth')->group(function() {
    Route::post('register/', 'AuthController@register');
    Route::post('login/', 'AuthController@authenticate');

    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::get('user/', 'AuthController@getAuthenticatedUser');
    });
});
