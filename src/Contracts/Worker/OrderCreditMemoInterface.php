<?php

namespace Fv\Minions\Contracts\Worker;

interface OrderCreditMemoInterface
{

    public function getOrderCreditMemos(array $filters);

    public function getOrderCreditMemo($id);

    public function createOrderCreditMemo($order_increment_id, array $data,
                                          $comment = '', $isNotify = false,
                                          $is_include_comment_in_email = false);

    public function addOrderCreditMemoComment($id, $comment = '',
                                              $isNotify = false,
                                              $is_include_comment_in_email = false);

    public function cancelOrderCreditMemo($id);
}
