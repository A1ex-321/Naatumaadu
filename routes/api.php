<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductDetailsController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\CategoryController;
use Laravel\Sanctum\Sanctum;




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

// Sanctum::routes();
// Route::apiResources(['products' => ProductDetailsController::class]);
// Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [LoginController::class, 'login']);
Route::apiResource('posts', PostController::class)->middleware('auth:sanctum');
Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/login', [AuthController::class, 'login']);
Route::apiResources(['products' => ProductDetailsController::class]);
Route::get('/records', [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'categorys']);




