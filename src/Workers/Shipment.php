<?php

namespace Fv\Minions\Workers;

use Fv\Minions\Contracts\Worker\ShipmentInterface;

class Shipment extends Worker implements ShipmentInterface
{

    public function getNewShipments(array $filters)
    {
        return $this->execute('salesOrderShipmentList', $filters);
    }

    public function getShipmentById($incrementId)
    {
        return $this->execute('salesOrderShipmentInfo', $incrementId);
    }

    public function createNewShipment($orderId)
    {
        return $this->getSoapService()->call('salesOrderShipmentCreate', [
                    $this->getSoapSession(),
                    $orderId
        ]);
    }

    public function addShipmentCarrier($shipmentId, $code, $carrier, $trackingNo)
    {
        return $this->getSoapService()->call('salesOrderShipmentAddTrack', [
                    $this->getSoapSession(),
                    $shipmentId,
                    $code,
                    $carrier,
                    $trackingNo
        ]);
    }

    public function getCarriers($orderId)
    {
        return $this->execute('salesOrderShipmentGetCarriers', $orderId);
    }

}
