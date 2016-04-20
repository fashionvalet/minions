<?php

namespace Fv\Minions\Contracts\Worker;

interface ShipmentInterface
{

    public function getNewShipments(array $filters);

    public function getShipmentById($incrementId);

    public function createNewShipment($orderId);

    public function createNewShipmentItems($orderId, array $items);

    public function addShipmentCarrier($shipmentId, $code, $carrier, $trackingNo);

    public function getCarriers($orderId);
}
