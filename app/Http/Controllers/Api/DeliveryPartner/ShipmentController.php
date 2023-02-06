<?php

namespace App\Http\Controllers\Api\DeliveryPartner;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use App\Services\ResponseService;
use App\Services\ShipmentService;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipments = Shipment::all();
        return (new ResponseService)->data(['shipments' => $shipments])->getResponse();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $action, $id)
    {

        $shipment = ShipmentService::findShipment($id);
        if($action == 'accept'){
            $shipment->status = Shipment::$statusAccepted;
            $shipment->save();
        }else if($action == 'delivered'){
            $shipment->status = Shipment::$statusDelivered;
            $shipment->save();
        }
        return (new ResponseService)->data(['shipments' => $shipment])->message("Shipment $action")->getResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
