<?php namespace Fv\Minions\Contracts\Worker;

interface OrderInterface
{
    public function getNewOrders(array $filters);

    public function getOrderById($incrementId);

    public function addCommentToOrder($incrementId, $status, $comment = null, $notify = false);

    public function cancelOrder($incrementId);

    public function holdOrder($incrementId);

    public function unholdOrder($incrementId);
}
