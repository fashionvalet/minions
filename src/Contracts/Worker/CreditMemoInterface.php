<?php

namespace Fv\Minions\Contracts\Worker;

interface CreditMemoInterface
{

    public function create($orderId, $invoiceId, $data);

    public function getCreditMemos(array $query);

    public function getCreditMemoById($id);
}
