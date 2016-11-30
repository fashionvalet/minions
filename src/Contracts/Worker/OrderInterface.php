<?php

namespace Fv\Minions\Contracts\Worker;

interface OrderInterface
{

    public function getNewOrders(array $filters);

    public function getOrderById($id);

    public function addCommentToOrder($incrementId, $status, $comment = null,
                                      $notify = false);

    public function cancelOrder($id);

    public function holdOrder($id);

    public function unholdOrder($id);

    public function getOrders(array $query = ['searchCriteria' => ['pageSize' => 100]]);

    public function getOrderByIncrementId($incrementId);
}
