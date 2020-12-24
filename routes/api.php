<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);

    Route::post('add-man', [UserController::class, 'add']);
    Route::get('get-men', [UserController::class, 'get']);
    Route::get("tree-family",[UserController::class,"treeFamily"]);
});

//Route::post('register', function(Request $request) {
//        \App\Models\User::create([
//           'name' => 'admin',
//           'email' => 'admin@gmail.com',
//           'password' => bcrypt($request['password'])
//        ]);
//    });
