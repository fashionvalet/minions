<?php

namespace Fv\Minions\Contracts\Worker;

interface OrderCreditMemoInterface
{

    public function getOrderCreditMemos(array $filters);

    public function getOrderCreditMemo($id);

    public function createOrderCreditMemo(array $data);

    public function addOrderCreditMemoComment($id, $comment = '',
                                              $isNotify = false,
                                              $isVisibleFrontend = false);

    public function cancelOrderCreditMemo($id);
}
