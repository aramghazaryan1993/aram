<?php

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
Route::post('forgot-password', [\App\Http\Controllers\API\AuthController::class, 'forgotPassword']);
Route::post('reset-password', [\App\Http\Controllers\API\AuthController::class, 'reset']);
// Route::post('/password/email', [\App\Http\Controllers\API\AuthController::class, 'sendPasswordResetLinkEmail'])->middleware(['guest']);
// Route::post('/password/reset', 'App\Http\Controllers\Api\Auth\AuthController@resetPassword')->name('password.reset');

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
Route::post('update-home/{id}', [\App\Http\Controllers\API\HomeController::class, 'updateHome']);
Route::delete('delete-home/{id}', [\App\Http\Controllers\API\HomeController::class, 'deleteHome']);

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

Route::get('get-service-gallery/{id}', [\App\Http\Controllers\API\ServiceGalleryController::class, 'getServiceGallery']);
Route::post('add-service-gallery', [\App\Http\Controllers\API\ServiceGalleryController::class, 'addServiceGallery']);
Route::post('update-service-gallery/{id}', [\App\Http\Controllers\API\ServiceGalleryController::class, 'updateServiceGallery']);
Route::delete('delete-service-gallery/{id}', [\App\Http\Controllers\API\ServiceGalleryController::class, 'deleteServiceGallery']);

Route::get('get-service-header-image/{id}', [\App\Http\Controllers\API\ServiceHeaderImageController::class, 'getServiceHeaderImage']);
Route::post('add-service-header-image', [\App\Http\Controllers\API\ServiceHeaderImageController::class, 'addServiceHeaderImage']);
Route::post('update-service-header-image/{id}', [\App\Http\Controllers\API\ServiceHeaderImageController::class, 'updateServiceHeaderImage']);
Route::delete('delete-service-header-image/{id}', [\App\Http\Controllers\API\ServiceHeaderImageController::class, 'deleteServiceHeaderImage']);

Route::get('get-about-us', [\App\Http\Controllers\API\AboutUsController::class, 'getAboutUs']);
Route::post('update-about-us', [\App\Http\Controllers\API\AboutUsController::class, 'updateAboutUs']);

Route::post('add-blog', [\App\Http\Controllers\API\BlogController::class, 'addBlog']);
Route::get('get-blog', [\App\Http\Controllers\API\BlogController::class, 'getBlog']);
Route::post('update-blog/{id}', [\App\Http\Controllers\API\BlogController::class, 'updateBlog']);
Route::delete('delete-blog/{id}', [\App\Http\Controllers\API\BlogController::class, 'deleteBlog']);

Route::post('add-service',[\App\Http\Controllers\API\ServiceController::class, 'addService']);
Route::get('get-service/{id}',[\App\Http\Controllers\API\ServiceController::class, 'getService']);
Route::post('update-service/{id}',[\App\Http\Controllers\API\ServiceController::class, 'updateService']);
Route::delete('delete-service/{id}',[\App\Http\Controllers\API\ServiceController::class, 'deleteService']);
