<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShipmentResource;
use App\Http\Resources\ShipmentStatusResource;
use App\Services\ResponseService;
use App\Services\Shipment\Service as ShipmentService;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function details($id)
    {
        $shipment = ShipmentService::findShipment($id);
        return (new ResponseService)
            ->data([
                'shipment' => new ShipmentResource($shipment),
            ])
            ->getResponse();
    }

    public function statues($id)
    {
        $statues = ShipmentService::getShipmentStatues($id);
        return (new ResponseService)
            ->data([
                "shipment_status" => ShipmentStatusResource::collection($statues)
            ])
            ->getResponse();
    }
}
