<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\RestaurentController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\KssController;

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
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [JWTAuthController::class, 'login']);
    Route::post('/register', [JWTAuthController::class, 'register']);
    Route::post('/logout', [JWTAuthController::class, 'logout']);
    Route::post('/refresh', [JWTAuthController::class, 'refresh']);
    Route::get('/user-profile', [JWTAuthController::class, 'userProfile']);    
});

Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::get('/ksssystems', [KssController::class, 'index']);
    Route::get('/ksssystem/{id}', [KssController::class, 'show']);  
    Route::post('/ksssystem-create', [KssController::class, 'store']);
    Route::put('/ksssystem-update/{id}', [KssController::class, 'update']);
    Route::delete('/ksssystem-delete/{id}', [KssController::class, 'destroy']);  
});

Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::get('/blogs', [BlogsController::class, 'index']);
    Route::get('/blog/{id}', [BlogsController::class, 'show']);  
    Route::post('/blog-create', [BlogsController::class, 'store']);
    Route::put('/blog-update/{id}', [BlogsController::class, 'update']);
    Route::delete('/blog-delete/{id}', [BlogsController::class, 'destroy']);  
});

Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::get('/documents', [DocumentsController::class, 'index']);
    Route::get('/document/{id}', [DocumentsController::class, 'show']);  
    Route::post('/document-create', [DocumentsController::class, 'store']);
    Route::put('/document-update/{id}', [DocumentsController::class, 'update']);
    Route::delete('/document-delete/{id}', [DocumentsController::class, 'destroy']);  
    //filter functions
    Route::get('/document-filter-title', [DocumentsController::class, 'title_filter']);
    Route::get('/document-filter-content', [DocumentsController::class, 'content_filter']);
    Route::get('/document-filter-category', [DocumentsController::class, 'category_filter']);
    Route::get('/document-filter-department', [DocumentsController::class, 'department_filter']);
});

Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::get('/events', [EventsController::class, 'index']);
    Route::get('/event/{id}', [EventsController::class, 'show']);
    Route::post('/event-create', [EventsController::class, 'store']);
    Route::put('/event-update/{id}', [EventsController::class, 'update']);
    Route::delete('/event-delete/{id}', [EventsController::class, 'destroy']);
});

Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::get('/restaurants', [RestaurentController::class, 'index']);
    Route::get('/restaurant/{id}', [RestaurentController::class, 'show']);
    Route::post('/restaurant-create', [RestaurentController::class, 'store']);
});