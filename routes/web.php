<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\RegisterController;
use App\Http\Controllers\Admin\BackgroundimageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Web\ProductDetailsController;
use App\Http\Controllers\web\CartController;
use App\Http\Controllers\web\CheckoutController;
use App\Http\Controllers\web\OrderDetailsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'admin'], function () {

    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('admin/admin/list', [AdminController::class, 'admin_list']);
    Route::get('admin/admin/add', [AdminController::class, 'admin_add']);
    Route::post('admin/admin/add', [AdminController::class, 'add_admin_insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'add_admin_edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'admin_add_update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'admin_add_delete']);

    Route::get('admin/category/list', [CategoryController::class, 'category_list']);
    Route::get('admin/category/add', [CategoryController::class, 'category_add']);
    Route::post('admin/category/add', [CategoryController::class, 'category_insert']);
    Route::get('admin/category/edit/{id}', [CategoryController::class, 'category_edit']);
    Route::post('admin/category/edit/{id}', [CategoryController::class, 'category_update']);
    Route::get('admin/category/delete/{id}', [CategoryController::class, 'category_delete']);


    Route::get('admin/brand/add', [BrandController::class, 'brand_add'])->name('add-new');
    Route::post('admin/brand/add', [BrandController::class, 'store']);
    Route::get('admin/brand/list', [BrandController::class, 'list'])->name('brand-list');
    Route::get('admin/brand/edit/{id}', [BrandController::class, 'brand_edit'])->name('edit-brand');
    Route::post('admin/brand/edit/{id}', [BrandController::class, 'brand_update']);
    Route::get('admin/brand/delete/{id}', [BrandController::class, 'brand_delete'])->name('delete-brand');

    Route::resource('admin/products', ProductController::class);

    Route::get('admin/allOrders', [OrdersController::class, 'listOrders'])->name('list-orders');
    Route::patch('/orders/{orderId}/update-status', [OrdersController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('/orders/{orderId}', [OrdersController::class, 'destroy'])->name('orders.destroy');
    Route::get('admin/orders/{orderId}/invoice', [OrdersController::class, 'generateInvoice'])->name('orders.generateInvoice');

    Route::resource('admin/gallery', GalleryController::class);
    Route::resource('admin/backgroundgallery', BackgroundimageController::class);

});


Route::get('admin', [AuthController::class, 'login']);
Route::post('admin', [AuthController::class, 'auth_login_admin']);
Route::get('admin/logout', [AuthController::class, 'logout_admin']);


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('services', [PageController::class, 'services'])->name('services');
Route::get('about', [PageController::class, 'about'])->name('about');
Route::get('contact', [PageController::class, 'contact'])->name('contact');
Route::get('cart-items', [PageController::class, 'cart'])->name('cart-items');
Route::get('/product/{productId}', [PageController::class, 'productDetails'])->name('product-details');

//terms and conditions
Route::get('refund-policy', [PageController::class, 'refundPolicy'])->name('refund-policy');
Route::get('terms', [PageController::class, 'terms'])->name('terms');
Route::get('privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('shipping', [PageController::class, 'shipping'])->name('shipping');
Route::get('gallery', [PageController::class, 'gallery'])->name('gallery');

//Promotional Page
Route::get('naattulife', [PageController::class, 'promotion'])->name('promotion');   

Route::middleware(['guest'])->group(function () {
    Route::get('login', [PageController::class, 'login'])->name('login');
    Route::post('login_submit', [LoginController::class, 'submit'])->name('login_post');

    Route::get('register', [PageController::class, 'register'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
});


Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/model/{productId}', [ProductDetailsController::class, 'getProductDetails']);

Route::middleware(['web'])->group(function () {
    Route::get('/cart/{productId}', [CartController::class, 'addToCart']);
    Route::get('/cart', [CartController::class, 'cartList'])->name('cart.index');
    Route::get('/deleteCartItem/{id}', [CartController::class, 'deleteCartItem'])->name('delete-cart');
    Route::post('/updateCartItem/{itemId}', [CartController::class, 'updateCartItem']);
});


//checkout_process
Route::get('/checkout/{id}', [PageController::class, 'checkout'])->name('checkout');
Route::post('/place-order', [CheckoutController::class, 'placeOrder'])->name('place-order');
Route::post('razorpay-payment',[CheckoutController::class,'store'])->name('razorpay.payment.store');

//orders

Route::get('my-orders', [OrderDetailsController::class, 'myOrders'])->name('my-orders');