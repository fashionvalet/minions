<?php namespace Fv\Minions\Workers;

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
}
