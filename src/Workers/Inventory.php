<?php

namespace Fv\Minions\Workers;

use Fv\Minions\Contracts\Worker\InventoryInterface;

/**
 * Author       : Rifki Yandhi
 * Date Created : Feb 16, 2016 11:30:51 AM
 * File         : Inventory.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     : 
 */
class Inventory extends Worker implements InventoryInterface
{

    public function stockList(array $product_ids)
    {
        return $this->execute('catalogInventoryStockItemList', $product_ids);
    }

    public function stockUpdate($product_id, $data)
    {
        return $this->getSoapService()->call('catalogInventoryStockItemUpdate', [
                    $this->getSoapSession(),
                    $product_id,
                    $data
        ]);
    }

}

/* End of file Inventory.php */