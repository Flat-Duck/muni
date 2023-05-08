<?php

use App\Http\Controllers\Api\Application\AuthController as ApplicationAuthController;
use App\Http\Controllers\Api\Application\ComplaintController as ApplicationComplaintController;
use App\Http\Controllers\Api\Application\ComplaintTypeController as ApplicationComplaintTypeController;
use App\Http\Controllers\Api\Application\MunicipalityController as ApplicationMunicipalityController;
use App\Http\Controllers\Api\Application\NewsController as ApplicationNewsController;
use App\Http\Controllers\Api\Application\NotificationController as ApplicationNotificationController;
use App\Http\Controllers\Api\Application\OrderController as ApplicationOrderController;
use App\Http\Controllers\Api\Application\OrderTypeController as ApplicationOrderTypeController;
use App\Http\Controllers\Api\Application\UserController as ApplicationUserController;
use App\Http\Controllers\Api\Dashboard\AuthController;
use App\Http\Controllers\Api\Dashboard\ComplaintController;
use App\Http\Controllers\Api\Dashboard\ComplaintTypeController;
use App\Http\Controllers\Api\Dashboard\MunicipalityController;
use App\Http\Controllers\Api\Dashboard\NewsController;
use App\Http\Controllers\Api\Dashboard\OrderController;
use App\Http\Controllers\Api\Dashboard\OrderTypeController;
use App\Http\Controllers\Api\Dashboard\PermissionController;
use App\Http\Controllers\Api\Dashboard\RoleController;
use App\Http\Controllers\Api\Dashboard\UserController;
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

//Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::name('api.application.')->prefix('application')->group(function () {
    Route::get('municipalities', [ApplicationMunicipalityController::class, 'index'])->name('municipalities.index');
    Route::post('register', [ApplicationAuthController::class, 'register'])->name('user.register');
    Route::post('login', [ApplicationAuthController::class, 'login'])->name('user.login');

    Route::middleware('auth:api') ->group(function () {
        Route::get('news', [ApplicationNewsController::class, 'index'])->name('news.index');

        Route::get('notifications', [ApplicationNotificationController::class, 'index'])->name('notifications.index');
        Route::get('notifications/{notification}', [ApplicationNotificationController::class, 'show'])->name('notifications.show');

        Route::get('complaint-types', [ApplicationComplaintTypeController::class,'index',])->name('complaint-types.index');

        Route::get('complaints', [ApplicationComplaintController::class, 'index'])->name('complaints,index');
        Route::post('complaints', [ApplicationComplaintController::class, 'store'])->name('complaints.store');

        Route::get('order-types', [ApplicationOrderTypeController::class,'index',])->name('order-types.index');

        Route::post('orders', [ApplicationOrderController::class, 'store'])->name('orders.store');
        Route::get('orders', [ApplicationOrderController::class, 'index'])->name('orders.index');

        Route::get('user', [ApplicationUserController::class, 'show'])->name('user.show');
        Route::patch('user', [ApplicationUserController::class, 'update'])->name('user.update');
    });
});

Route::name('api.dashboard.')->prefix('dashboard')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('user.login');
    Route::middleware('auth:api') ->group(function () {
        Route::get('/user', function (Request $request) {return $request->user();})->name('api.user');
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);
        Route::apiResource('complaints', ComplaintController::class);
        Route::apiResource('municipalities', MunicipalityController::class);
        Route::apiResource('all-news', NewsController::class);
        //Route::apiResource('notifications', NotificationController::class);
        Route::apiResource('orders', OrderController::class);
        Route::apiResource('order-types', OrderTypeController::class);
        Route::apiResource('complaint-types', ComplaintTypeController::class);
        Route::apiResource('users', UserController::class);
    });
});




// Route::name('api.')->middleware('auth:sanctum')->group(function () {



//         // Municipality All News
//         Route::get('/municipalities/{municipality}/all-news', [MunicipalityAllNewsController::class,'index',])->name('municipalities.all-news.index');
//         Route::post('/municipalities/{municipality}/all-news', [MunicipalityAllNewsController::class,'store',])->name('municipalities.all-news.store');

//         // Municipality Users
//         Route::get('/municipalities/{municipality}/users', [MunicipalityUsersController::class,'index',])->name('municipalities.users.index');
//         Route::post('/municipalities/{municipality}/users', [MunicipalityUsersController::class,'store',])->name('municipalities.users.store');

//         // Municipality Complaints
//         Route::get('/municipalities/{municipality}/complaints', [MunicipalityComplaintsController::class,'index',])->name('municipalities.complaints.index');
//         Route::post('/municipalities/{municipality}/complaints', [MunicipalityComplaintsController::class,'store',])->name('municipalities.complaints.store');

//         // Municipality Orders
//         Route::get('/municipalities/{municipality}/orders', [MunicipalityOrdersController::class,'index',])->name('municipalities.orders.index');
//         Route::post('/municipalities/{municipality}/orders', [MunicipalityOrdersController::class,'store',])->name('municipalities.orders.store');

//         // OrderType Orders
//         Route::get('/order-types/{orderType}/orders', [OrderTypeOrdersController::class,'index',])->name('order-types.orders.index');
//         Route::post('/order-types/{orderType}/orders', [OrderTypeOrdersController::class,'store',])->name('order-types.orders.store');

//         // User Notifications
//         Route::get('/users/{user}/notifications', [UserNotificationsController::class,'index',])->name('users.notifications.index');
//         Route::post('/users/{user}/notifications', [UserNotificationsController::class,'store',])->name('users.notifications.store');

//         // User Complaints
//         Route::get('/users/{user}/complaints', [UserComplaintsController::class,'index',])->name('users.complaints.index');
//         Route::post('/users/{user}/complaints', [UserComplaintsController::class,'store',])->name('users.complaints.store');

//         // User Orders
//         Route::get('/users/{user}/orders', [UserOrdersController::class,'index',])->name('users.orders.index');
//         Route::post('/users/{user}/orders', [UserOrdersController::class,'store',])->name('users.orders.store');

//         // ComplaintType Complaints
//         Route::get('/complaint-types/{complaintType}/complaints', [ComplaintTypeComplaintsController::class,'index',])->name('complaint-types.complaints.index');
//         Route::post('/complaint-types/{complaintType}/complaints', [ComplaintTypeComplaintsController::class,'store',])->name('complaint-types.complaints.store');
//     });
