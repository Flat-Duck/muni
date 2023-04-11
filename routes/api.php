<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\OrderTypeController;
use App\Http\Controllers\Api\UserOrdersController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\MunicipalityController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\UserComplaintsController;
use App\Http\Controllers\Api\OrderTypeOrdersController;
use App\Http\Controllers\Api\MunicipalityUsersController;
use App\Http\Controllers\Api\UserNotificationsController;
use App\Http\Controllers\Api\MunicipalityOrdersController;
use App\Http\Controllers\Api\MunicipalityAllNewsController;
use App\Http\Controllers\Api\MunicipalityComplaintsController;

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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('complaints', ComplaintController::class);

        Route::apiResource('municipalities', MunicipalityController::class);

        // Municipality All News
        Route::get('/municipalities/{municipality}/all-news', [
            MunicipalityAllNewsController::class,
            'index',
        ])->name('municipalities.all-news.index');
        Route::post('/municipalities/{municipality}/all-news', [
            MunicipalityAllNewsController::class,
            'store',
        ])->name('municipalities.all-news.store');

        // Municipality Users
        Route::get('/municipalities/{municipality}/users', [
            MunicipalityUsersController::class,
            'index',
        ])->name('municipalities.users.index');
        Route::post('/municipalities/{municipality}/users', [
            MunicipalityUsersController::class,
            'store',
        ])->name('municipalities.users.store');

        // Municipality Complaints
        Route::get('/municipalities/{municipality}/complaints', [
            MunicipalityComplaintsController::class,
            'index',
        ])->name('municipalities.complaints.index');
        Route::post('/municipalities/{municipality}/complaints', [
            MunicipalityComplaintsController::class,
            'store',
        ])->name('municipalities.complaints.store');

        // Municipality Orders
        Route::get('/municipalities/{municipality}/orders', [
            MunicipalityOrdersController::class,
            'index',
        ])->name('municipalities.orders.index');
        Route::post('/municipalities/{municipality}/orders', [
            MunicipalityOrdersController::class,
            'store',
        ])->name('municipalities.orders.store');

        Route::apiResource('all-news', NewsController::class);

        Route::apiResource('notifications', NotificationController::class);

        Route::apiResource('orders', OrderController::class);

        Route::apiResource('order-types', OrderTypeController::class);

        // OrderType Orders
        Route::get('/order-types/{orderType}/orders', [
            OrderTypeOrdersController::class,
            'index',
        ])->name('order-types.orders.index');
        Route::post('/order-types/{orderType}/orders', [
            OrderTypeOrdersController::class,
            'store',
        ])->name('order-types.orders.store');

        Route::apiResource('users', UserController::class);

        // User Notifications
        Route::get('/users/{user}/notifications', [
            UserNotificationsController::class,
            'index',
        ])->name('users.notifications.index');
        Route::post('/users/{user}/notifications', [
            UserNotificationsController::class,
            'store',
        ])->name('users.notifications.store');

        // User Complaints
        Route::get('/users/{user}/complaints', [
            UserComplaintsController::class,
            'index',
        ])->name('users.complaints.index');
        Route::post('/users/{user}/complaints', [
            UserComplaintsController::class,
            'store',
        ])->name('users.complaints.store');

        // User Orders
        Route::get('/users/{user}/orders', [
            UserOrdersController::class,
            'index',
        ])->name('users.orders.index');
        Route::post('/users/{user}/orders', [
            UserOrdersController::class,
            'store',
        ])->name('users.orders.store');
    });
