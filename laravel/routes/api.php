<?php

use App\Http\Controllers\Api\v1\ApiAuthorController;
use App\Http\Controllers\Api\v1\ApiAuthController;
use App\Http\Controllers\Api\v1\ApiBookController;
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

Route::group([
    'as' => 'api.',
    'prefix' => '/v1',
    'middleware' => 'api',
],function (){

    Route::group([
        'as' => 'auth.',
        'prefix' => 'auth'
    ], function ($router) {
        Route::post('login', [ApiAuthController::class, 'login'])->name('login');
        Route::post('logout', [ApiAuthController::class, 'logout']);
        Route::post('refresh', [ApiAuthController::class, 'refresh']);
        Route::post('me', [ApiAuthController::class, 'me'])->name('me');
    });

    Route::group([
        'middleware' => 'auth:api'
    ], function ($router) {
        Route::apiResource('authors', ApiAuthorController::class, [ 'except'=>['update','destroy'] ]);
        Route::apiResource('books', ApiBookController::class, [ 'except'=>['destroy'] ]);
    });

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
