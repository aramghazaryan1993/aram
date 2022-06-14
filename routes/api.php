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

Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('register', [\App\Http\Controllers\API\AuthController::class, 'register']);
    Route::get('get-user', [\App\Http\Controllers\API\AuthController::class, 'getUser']);
    Route::post('update-user/{id}', [\App\Http\Controllers\API\AuthController::class, 'updateUser']);
    Route::delete('delete-user/{id}', [\App\Http\Controllers\API\AuthController::class, 'delete']);
    Route::post('logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);
});

Route::get('get-home', [\App\Http\Controllers\API\HomeController::class, 'getHome']);
Route::post('add-home', [\App\Http\Controllers\API\HomeController::class, 'addHome']);
Route::post('update-home/{id}', [\App\Http\Controllers\API\HomeController::class, 'update']);
Route::delete('delete-home/{id}', [\App\Http\Controllers\API\HomeController::class, 'delete']);

Route::get('get-adress-menu/{id}', [\App\Http\Controllers\API\AdressMenuController::class, 'getAdressMenu']);
Route::post('add-adress-menu', [\App\Http\Controllers\API\AdressMenuController::class, 'addAdressMenu']);
Route::post('update-adress-menu/{id}', [\App\Http\Controllers\API\AdressMenuController::class, 'updateAdressMenu']);
Route::delete('delete-adress-menu/{id}', [\App\Http\Controllers\API\AdressMenuController::class, 'deleteAdressMenu']);

Route::get('get-home-gallery', [\App\Http\Controllers\API\HomeController::class, 'getHomeGallery']);
Route::post('add-home-gallery', [\App\Http\Controllers\API\HomeController::class, 'addHomeGallery']);
Route::post('update-home-gallery/{id}', [\App\Http\Controllers\API\HomeController::class, 'updateHomeGallery']);
Route::delete('delete-home-gallery/{id}', [\App\Http\Controllers\API\HomeController::class, 'deleteHomeGallery']);

Route::get('contact', [\App\Http\Controllers\API\ContactController::class, 'getContact']);
Route::post('update-contact', [\App\Http\Controllers\API\ContactController::class, 'update']);

Route::get('get-menu', [\App\Http\Controllers\API\MenuController::class, 'getMenu']);
Route::get('get-submenu', [\App\Http\Controllers\API\MenuController::class, 'getSubMenu']);
Route::get('get-childemenu', [\App\Http\Controllers\API\MenuController::class, 'getChildeMenu']);
