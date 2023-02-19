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
    
    public function getUnAccepted()
    {
        $shipments = DeliveryPartner::unAccepted(auth()->user());
        return (new ResponseService)->data([
            'shipments' => ShipmentResource::collection($shipments)
        ])->getResponse();
    }

    public function getAcepted()
    {
        $shipments = DeliveryPartner::getByStatus(auth()->user(), Shipment::$statusAccepted);
        return (new ResponseService)->data([
            'shipments' => ShipmentResource::collection($shipments)
        ])->getResponse();
    }

    public function getDelivered()
    {
        $shipments = DeliveryPartner::getByStatus(auth()->user(), Shipment::$statusDelivered);
        return (new ResponseService)->data([
            'shipments' => ShipmentResource::collection($shipments)
        ])->getResponse();
    }

    public function all()
    {
        $shipments = DeliveryPartner::all(auth()->user());
        return (new ResponseService)->data([
            'shipments' => ShipmentResource::collection($shipments)
        ])->getResponse();
    }

    public function accept($id)
    {
        $shipment = ShipmentService::findShipment($id);
        $message = 'Shipment already accepted.';
        if ($shipment->status == Shipment::$statusOrderPlaced) {
            $user = auth()->user();
            $shipment->delivery_partner_id = $user->id;
            $shipment->status = Shipment::$statusAccepted;
            $shipment->save();
            ShipmentService::logStatus($shipment, $user);
            $message = 'Shipment accepted successfully.';
        }
        return (new ResponseService)->data([
                'shipments' => new ShipmentResource($shipment)
            ])  
            ->message($message)
            ->getResponse();
    }

    public function delivered($id)
    {
        $shipment = ShipmentService::findShipment($id);
        $shipment->status = Shipment::$statusDelivered;
        $shipment->save();
        $user = auth()->user();
        ShipmentService::logStatus($shipment, $user);
        return (new ResponseService)->data([
                'shipments' => new ShipmentResource($shipment)
            ])
            ->message('Shipment delivered successfully.')
            ->getResponse();
    }
    
}
