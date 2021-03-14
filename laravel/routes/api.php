<?php

use App\Http\Controllers\Api\v1\ApiAuthorController;
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

//@todo Указать в документацию что надо отправлять заголовок Accept: application/json
Route::group([
    'as' => 'api.',
    'prefix' => '/v1',
    //'middleware' => ['auth:api']
],function (){
    Route::apiResources([
       'authors' => ApiAuthorController::class,
       'books' => ApiBookController::class
    ]);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
