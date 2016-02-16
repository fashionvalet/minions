<?php

namespace Fv\Minions\Contracts\Worker;

interface InventoryInterface
{

    public function stockUpdate($product_id, $data);

    public function stockList(array $product_ids);
}
