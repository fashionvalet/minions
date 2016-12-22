<?php

namespace Fv\Minions\Workers;

use Fv\Minions\Contracts\Worker\ShipmentTrackInterface;
use GuzzleHttp\Exception\ClientException;

/**
 * Author       : Rifki Yandhi
 * Date Created : Nov 17, 2016 11:29:27 AM
 * File         : ShipmentTrack.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     : 
 */
class ShipmentTrack extends Worker implements ShipmentTrackInterface
{

    public function addShipmentTrack($shipmentId, $data)
    {
       
    }

}

/* End of file ShipmentTrack.php */