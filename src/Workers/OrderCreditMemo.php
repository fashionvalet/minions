<?php

namespace Fv\Minions\Workers;

use Fv\Minions\Contracts\Worker\OrderCreditMemoInterface;

class OrderCreditMemo extends Worker implements OrderCreditMemoInterface
{

    public function getOrderCreditMemo($id)
    {
        return $this->execute('salesOrderCreditmemoInfo', $id);
    }

    public function getOrderCreditMemos(array $filters)
    {
        return $this->execute('salesOrderCreditmemoList', $filters);
    }

    public function createOrderCreditMemo($order_increment_id, array $data,
                                          $comment = '', $is_notify = false,
                                          $is_include_comment_in_email = false)
    {
        return $this->getSoapService()->call('salesOrderCreditmemoCreate', [
                    $this->getSoapSession(),
                    $order_increment_id,
                    $data,
                    $comment,
                    $is_notify,
                    $is_include_comment_in_email
        ]);
    }

    public function addOrderCreditMemoComment($id, $comment = '',
                                              $is_notify = false,
                                              $is_include_comment_in_email = false)
    {
        return $this->getSoapService()->call('salesOrderCreditmemoAddComment', [
                    $this->getSoapSession(),
                    $id,
                    $comment,
                    $is_notify,
                    $is_include_comment_in_email
        ]);
    }

    public function cancelOrderCreditMemo($id)
    {
        return $this->execute('salesOrderCreditmemoCreate', $id);
    }

}
