<?php

use App\Http\Controllers\Api\AuthController;
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

Route::post('delivery-partner-regiseter', [AuthController::class, "addDeleverPartner"]);
Route::post('customer-regiseter', [AuthController::class, "addCustomerPartner"]);

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('update-device-token', [AuthController::class, 'updateDeviceToken'])->middleware('auth:sanctum');
    Route::post('update-co-ordinates', [AuthController::class, 'updateCoOrdinates'])->middleware('auth:sanctum');
    Route::post('forgot/password', [AuthController::class, 'forgotPassword']);
    Route::post('change/{requestFor}', [AuthController::class, 'changeChredentials'])->middleware('auth:sanctum');
    Route::post('check/password', [AuthController::class, 'checkPassword'])->middleware('auth:sanctum');
    Route::post('check/{reqeustFor}', [AuthController::class, 'checkChredentials']);
    Route::get('search/{reqeustFor}/{id?}', [HomePageController::class, 'search']);
    Route::post('status', [AuthController::class, 'status'])->middleware('auth:sanctum');
    Route::post('approved', [AuthController::class, 'approved'])->middleware('auth:sanctum');
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('family-tokens', [AuthController::class, 'familyTokens'])->middleware('auth:sanctum');
    Route::post('social/login', [AuthController::class, 'socialLogin']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::get('check/{slug}/exists', [AuthController::class, 'checkExists']);
