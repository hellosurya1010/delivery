<?php

namespace App\Http\Controllers\Api\DeliveryPartner;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShipmentResource;
use App\Models\Shipment;
use App\Services\ResponseService;
use App\Services\Shipment\DeliveryPartner;
use App\Services\Shipment\Service as ShipmentService;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($slug)
    {
        $shipments = null;
        if ($slug == "un-accepted-shipments") {
            // $shipments = Shipment::all();
        }
    }


    public function unAccepted()
    {
        $shipments = DeliveryPartner::unAccepted(auth()->user());
        return (new ResponseService)->data([
            'shipments' => ShipmentResource::collection($shipments)
        ])->getResponse();
    }

    public function accept($id)
    {
        $shipment = ShipmentService::findShipment($id);
        $status = Shipment::$statusAccepted;
        $user = auth()->user();
        ShipmentService::updateStatus($shipment, $status, $user);
        return (new ResponseService)
            ->message('Shipment accepted successfully.')
            ->getResponse();
    }

    public function delivered($id)
    {
        $shipment = ShipmentService::findShipment($id);
        $status = Shipment::$statusDelivered;
        $user = auth()->user();
        ShipmentService::updateStatus($shipment, $status, $user);
        return (new ResponseService)
            ->message('Shipment delivered successfully.')
            ->getResponse();
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


        if ($action == 'accept') {
        } else if ($action == 'delivered') {
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
