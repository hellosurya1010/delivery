<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Customer\ShipmentController as CustomerShipmentController;
use App\Http\Controllers\Api\DeliveryPartner\ShipmentController as DeliveryPartnerShipmentController;
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
    Route::get('get-countries', [AuthController::class, "getCountrires"]);
    Route::get('get-states/{countryId}', [AuthController::class, "getStates"]);
    Route::get('get-cities/{stateId}', [AuthController::class, "getCities"]);
    Route::patch('update-device-token', [AuthController::class, 'updateDeviceToken'])->middleware('auth:sanctum');
    Route::patch('update-co-ordinates', [AuthController::class, 'updateCoOrdinates'])->middleware('auth:sanctum');
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::group(["middleware" => "auth:sanctum"], function () {
    Route::group(["middleware" => ['isApiCustomer']], function () {
        Route::apiResource('customer-shipment.action', CustomerShipmentController::class);
    });
    Route::group(["middleware" => ['isApiDeliveryPartner']], function () {
        Route::apiResource('delivery-partner-shipment.action', DeliveryPartnerShipmentController::class);
    });
});

Route::get('check/{slug}/exists', [AuthController::class, 'checkExists']);
