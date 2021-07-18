<?php
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::put('/user/edit', [UserController::class, 'edit'])->middleware('auth:api');
Route::put('/user/changePassword', [UserController::class, 'changePassword'])->middleware('auth:api');

Route::get('/categories/get', [CategoryController::class, 'get']);

Route::get('/products/get', [ProductController::class, 'get']);
Route::post('/products/search', [ProductController::class, 'search']);

Route::post('/setorder', [OrderController::class, 'setOrder'])->middleware('auth:api');
