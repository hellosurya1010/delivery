<?php

use App\Http\Controllers\Web\AjaxController;
use App\Http\Controllers\Web\AjaxInputController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\CustomerController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\DataTableController;
use App\Http\Controllers\Web\DeliveryPartnerController;
use App\Http\Controllers\Web\SettingsController;
use App\Http\Controllers\Web\ShipmentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
    return view('welcome');
});

Route::middleware(['auth', 'isAdmin', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource("customers", CustomerController::class)->name('admin', 'customers');
    Route::resource("shipments", ShipmentController::class)->name('admin', 'shipments');
    Route::resource("delivery-partners", DeliveryPartnerController::class)->name('admin', 'delivery-partner');  
Route::resource('settings', SettingsController::class)->name('settings', 'settings');
});

Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function () {
    Route::get('states/{countryId?}', [AjaxInputController::class, "getStates"])->name('states');
    Route::get('cities/{stateId?}', [AjaxInputController::class, "getCities"])->name('cities');
    Route::get('check/{slug}/exists', [AuthController::class, 'checkExists']);
});

Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
    Route::get('delivery-partners', [DataTableController::class, "deliveryPartners"])->name('delivery-partners');
    Route::get('customers', [DataTableController::class, "customers"])->name('customers');
});
