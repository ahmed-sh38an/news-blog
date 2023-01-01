<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('guest')->group(function () {
    Route::post('/admin/register', [AdminController::class, 'register']);
    Route::post('/admin/login', [AdminController::class, 'login']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth:user')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/comment', [CommentController::class, 'store']);
    Route::post('/like/{post:id}', [LikeController::class, 'store']);
});

Route::middleware('auth:admins')->group(function () {
    Route::post('/admin/logout', [AdminController::class, 'logout']);
    Route::post('/create', [PostController::class, 'store']);
    Route::put('/edit/{post:id}', [PostController::class, 'update']);
    Route::delete('/delete/{post:id}', [PostController::class, 'destroy']);
});

Route::get('/index', [PostController::class, 'index']);
Route::get('/index/{post:slug}', [PostController::class, 'show']);
Route::get('/comment/{post:id}', [CommentController::class, 'index']);
Route::get('/like/{post:id}', [LikeController::class, 'count']);

Route::get('/foo', function () {
    return 'bar';
})->middleware('auth:api');