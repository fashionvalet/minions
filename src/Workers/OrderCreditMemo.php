<?php

namespace Fv\Minions\Workers;

use Fv\Minions\Contracts\Worker\OrderCreditMemoInterface;

class OrderCreditMemo extends Worker implements OrderCreditMemoInterface
{

    public function getOrderCreditMemo($id)
    {

    }

    public function getOrderCreditMemos(array $filters)
    {

    }

    public function createOrderCreditMemo($order_increment_id, array $data,
                                          $comment = '', $is_notify = false,
                                          $is_include_comment_in_email = false)
    {

    }

    public function addOrderCreditMemoComment($id, $comment = '',
                                              $is_notify = false,
                                              $is_include_comment_in_email = false)
    {
        
    }

    public function cancelOrderCreditMemo($id)
    {

    }

}
