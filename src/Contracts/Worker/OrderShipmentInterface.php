<?php

namespace Fv\Minions\Contracts\Worker;

/**
 * Author       : Rifki Yandhi
 * Date Created : Nov 15, 2016 5:18:13 PM
 * File         : OrderShipment.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     :
 */
interface OrderShipmentInterface
{

    /**
     *
     * @param int $orderId
     * @param array $items [orderItemId, qty]
     * @param array $tracks [[trackNumber, title, carrierCode]]
     * @param array $comment [comment, isVisibleOnFront]
     * @param boolean $isNotify
     * @param boolean $isAppendComment
     */
    public function create($orderId, $items, $tracks, $comment,
                           $isNotify = false, $isAppendComment = false);
}

/* End of file OrderShipment.php */