<?php

namespace Fv\Minions\Workers;

use Fv\Minions\Contracts\Worker\ShipmentInterface;

class Shipment extends Worker implements ShipmentInterface
{

    public function getNewShipments(array $filters)
    {

    }

    public function getShipmentById($incrementId)
    {

    }

    public function createNewShipment($orderId)
    {
        
    }

    public function addShipmentCarrier($shipmentId, $code, $carrier, $trackingNo)
    {
        
    }

    public function getCarriers($orderId)
    {

    }

    public function createNewShipmentItems($orderId, array $items,
                                           $comment = '', $isNotify = false,
                                           $isIncludeCommentInEmail = false)
    {
        
    }

}
