<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\NewsController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group([
    'middleware' => ['api', 'auth:api'],
], function ($router) {

    Route::post('logout', [AuthController::class, 'logout']);


    Route::post('add-man', [UserController::class, 'add']);
    Route::get('get-men', [UserController::class, 'get']);

    Route::get("tree-family2",[UserController::class,"treeFamily2"]);


//Galleries

    Route::post("gallery-create",[GalleryController::class,"create"]);
    Route::post("gallery-update/",[GalleryController::class,"update"]);
    Route::delete("gallery-delete/{id}",[GalleryController::class,"delete"]);
    //News
    //Galleries

    Route::post("news-create",[NewsController::class,"create"]);
    Route::post("news-update/",[NewsController::class,"update"]);
    Route::delete("news-delete/{id}",[NewsController::class,"delete"]);

});
Route::get('families', [UserController::class, 'family']);
Route::get('families/{id}', [UserController::class, 'getUser']);
Route::patch('/families/{id}', [UserController::class, 'update']);
Route::get('findFamilies', [UserController::class, 'search']);
Route::delete('families/{id}', [UserController::class, 'deleteFamily']);
Route::post('login', [AuthController::class, 'login']);
Route::get('user', [AuthController::class, 'user']);
Route::get("gallery",[GalleryController::class,"index"]);
Route::get("news",[NewsController::class,"index"]);
Route::get("/news-show/{id}",[NewsController::class,"show"]);
Route::get("tree-family",[UserController::class,"treeFamily"]);
Route::get("member",[UserController::class,"member"]);
Route::get("/data",[\App\Http\Controllers\Api\FrontendController::class,"data"]);
