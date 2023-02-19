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

Route::middleware("auth:sanctum")->group(function () {

    Route::get('settings', [AuthController::class, 'getSettings']);

    Route::group(["middleware" => ['isCustomer']], function () {
        Route::apiResource('customer-shipment.action', CustomerShipmentController::class);
    });
    
    Route::prefix("customer/shipments")->middleware(['isCustomer'])->group(function () {
        Route::get('create', [CustomerShipmentController::class, 'unAccepted']);
    });
    
    Route::prefix("shipments")->group(function () {
        Route::get('detials', [CustomerShipmentController::class, 'unAccepted']);
    });

    Route::prefix("delivery-partner/shipments")->middleware(['isDeliveryPartner'])->group(function () {
        Route::get('un-accepted', [DeliveryPartnerShipmentController::class, 'unAccepted']);
        Route::get('details/{shipmentId}', [DeliveryPartnerShipmentController::class, 'accept']);
        Route::patch('accept/{shipmentId}', [DeliveryPartnerShipmentController::class, 'accept']);
        Route::patch('delivered/{shipmentId}', [DeliveryPartnerShipmentController::class, 'delivered']);
        Route::get('all', [DeliveryPartnerShipmentController::class, 'index']);
    });
});

Route::get('check/{slug}/exists', [AuthController::class, 'checkExists']);
