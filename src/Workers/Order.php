<?php namespace Fv\Minions\Workers;

use Fv\Minions\Contracts\Worker\OrderInterface;

class Order extends Worker implements OrderInterface
{
    public function getNewOrders(array $filters)
    {
        return $this->execute('salesOrderList', $filters);
    }

    public function getOrderById($incrementId)
    {
        return $this->execute('salesOrderInfo', $incrementId);
    }

    public function addCommentToOrder($incrementId, $status, $comment = null, $notify = false)
    {
        return $this->getSoapService()->call('salesOrderAddComment', [
            $this->getSoapSession(),
            $incrementId,
            $status,
            $comment,
            $notify
        ]);
    }

    public function cancelOrder($incrementId)
    {
        return $this->execute('salesOrderCancel', $incrementId);
    }

    public function holdOrder($incrementId)
    {
        return $this->execute('salesOrderHold', $incrementId);
    }

    public function unholdOrder($incrementId)
    {
        return $this->execute('salesOrderUnhold', $incrementId);
    }
}
