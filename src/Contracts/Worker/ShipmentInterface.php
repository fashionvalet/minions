<?php namespace Fv\Minions\Contracts\Worker;

interface ShipmentInterface
{
    public function getNewShipments(array $filters);

    public function getShipmentById($incrementId);
}
