<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::prefix('movies')->group(function () {
    Route::get('/index', [MovieController::class, 'index']);
    Route::post('/index', [MovieController::class, 'index']);
    Route::get('/get/{movie:slug}', [MovieController::class, 'show']);
    Route::middleware('auth:sanctum', 'role:admin')->group(function () {
        Route::post('/create', [MovieController::class, 'store']);
        Route::put('/update/{movie:slug}', [MovieController::class, 'update']);
        Route::delete('/delete/{movie:slug}', [MovieController::class, 'destroy']);
    });
    Route::get('/{movie:slug}/posts', [MovieController::class, 'getMoviePosts']);
    Route::get('/by/{userSlug}', [MovieController::class, 'getMoviesByUser']);
    Route::post('/{movie:slug}/favorite', [MovieController::class, 'favorite'])->middleware('auth:sanctum');
});

Route::prefix('posts')->group(function () {
    Route::get('/index', [PostController::class, 'index']);
    Route::get('/get/{post:slug}', [PostController::class, 'show']);
    Route::post('/create', [PostController::class, 'store']);
    Route::put('/update/{post:slug}', [PostController::class, 'update']);
    Route::delete('/delete/{post:slug}', [PostController::class, 'destroy']);
    Route::get('/by/{userSlug}', [PostController::class, 'getPostsByUser']);
});

Route::prefix('users')->group(function () {
    Route::get('/index', [UserController::class, 'index']);
    Route::get('/get/{user:slug}', [UserController::class, 'show']);
    Route::put('/update/{user:slug}', [UserController::class, 'update']);
    Route::delete('/delete/{user:slug}', [UserController::class, 'destroy']);
    Route::get('/{user:slug}/favorites', [UserController::class, 'favorites'])->middleware('auth:sanctum');
});




