<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateShipmentRequest;
use App\Http\Resources\ShipmentResource;
use App\Models\Shipment;
use App\Services\ResponseService;
use App\Services\Shipment\Customer;
use App\Services\Shipment\Service as ShipmentService;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{

    public function getUnAccepted()
    {
        $shipments = Customer::getByStatus(auth()->user(), Shipment::$statusOrderPlaced);
        return (new ResponseService)->data([
            'shipments' => ShipmentResource::collection($shipments)
        ])->getResponse();
    }

    public function getAcepted()
    {
        $shipments = Customer::getByStatus(auth()->user(), Shipment::$statusAccepted);
        return (new ResponseService)->data([
            'shipments' => ShipmentResource::collection($shipments)
        ])->getResponse();
    }

    public function getDelivered()
    {
        $shipments = Customer::getByStatus(auth()->user(), Shipment::$statusDelivered);
        return (new ResponseService)->data([
            'shipments' => ShipmentResource::collection($shipments)
        ])->getResponse();
    }

    public function all()
    {
        $shipments = Customer::all(auth()->user());
        return (new ResponseService)->data([
            'shipments' => ShipmentResource::collection($shipments)
        ])->getResponse();
    }

    public function create(CreateShipmentRequest $request)
    {
        $fileds = $request->validated();
        $shipment = ShipmentService::makeShipment(auth()->user(), $fileds);
        return (new ResponseService)->data(['shipment' => $shipment])->getResponse();
    }
}
