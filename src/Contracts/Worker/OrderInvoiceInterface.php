<?php

namespace Fv\Minions\Contracts\Worker;

interface OrderInvoiceInterface
{
    public function create($orderId, $items, $comment, $isNotify = false,
                           $isAppendComment = false);
}
