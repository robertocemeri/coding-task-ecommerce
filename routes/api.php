<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\NotificationController;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
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

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    //product routes
    Route::get('products', [ProductController::class, 'index'])->name('products.list');
    Route::post('products/store', [ProductController::class, 'store'])->name('products.store');
    Route::post('products/bid', [ProductController::class, 'place_bid'])->name('products.bid');
    Route::post('products/buy-now', [ProductController::class, 'buy_now'])->name('products.buy_now');
    Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('user/products', [ProductController::class, 'get_all_products_by_user'])->name('user.products');
    Route::get('user/purchases', [ProductController::class, 'get_all_purchases_by_user'])->name('user.purchases');
    Route::get('/categories', function (Request $request) {
        return response()->json([
            'data' => Category::all(),
            'message'=> 'Success!'
        ], Response::HTTP_OK);

    });
    Route::get('user/notifications', [NotificationController::class, 'get_all_notifications_for_user'])->name('user.notifications');
    Route::get('user/notifications-count', [NotificationController::class, 'get_unread_notifications_counts_for_user'])->name('user.notifications_count');
    Route::get('user/read-all-notifications', [NotificationController::class, 'read_all_notifications_for_user'])->name('user.read_all_notifications');

});