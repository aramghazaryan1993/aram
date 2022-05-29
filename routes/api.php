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

Route::get('test', [\App\Http\Controllers\API\ContactController::class, 'test']);

Route::get('contact', [\App\Http\Controllers\API\ContactController::class, 'getContact']);
Route::post('update-contact', [\App\Http\Controllers\API\ContactController::class, 'update']);

Route::get('get-menu', [\App\Http\Controllers\API\MenuController::class, 'getMenu']);
Route::get('get-submenu', [\App\Http\Controllers\API\MenuController::class, 'getSubMenu']);
Route::get('get-childemenu', [\App\Http\Controllers\API\MenuController::class, 'getChildeMenu']);

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    //return $request->user();
//    Route::get('contact', [\App\Http\Controllers\API\ContactController::class, 'index']);
//});
