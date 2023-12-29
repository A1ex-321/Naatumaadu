<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductDetailsController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Api\PaymentController;



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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::apiResources(['products' => ProductDetailsController::class]);
Route::get('/records', [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'categorys']);
Route::post('/addtocart', [CartController::class, 'addToCart']);
Route::post('/cartlist', [CartController::class, 'cartList']);
// Route::get('/product_all/{id}', [ProductController::class, 'product_all']);

// Route::get('/product_all/{id}', [ProductDetailsController::class, 'product_all']);
// Route::get('/api/product_all/{ID}', 'API\ProductDetailsController@product_all');


Route::post('/updateCartItem/{itemId}', [CartController::class, 'updateCartItem']);
Route::get('/deleteCartItem/{id}', [CartController::class, 'deleteCartItem']);



Route::post('/place-order', [PaymentController::class, 'placeOrder']);
Route::post('/payment/store', [PaymentController::class, 'store']);
Route::post('/orders', [PaymentController::class, 'Orders']);
Route::get('/image', [ImageController::class, 'getbackgroundimage']);
Route::get('/gallery', [ImageController::class, 'getgallery']);
Route::get('/herogallery', [ImageController::class, 'getherogallery']);














