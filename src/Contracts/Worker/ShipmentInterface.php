<?php

namespace Fv\Minions\Contracts\Worker;

interface ShipmentInterface
{

    public function getNewShipments(array $filters);

    public function getShipmentById($incrementId);

    public function createNewShipment($orderId);

    public function createNewShipmentItems($orderId, array $items,
                                           $comment = '', $isNotify = false,
                                           $isIncludeCommentInEmail = false);

    public function addShipmentCarrier($shipmentId, $code, $carrier, $trackingNo);

    public function getCarriers($orderId);
}
