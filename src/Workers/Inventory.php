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

    /**
     * @param array $product_ids Array of product id or sku
     * @return mixed
     */
    public function stockList(array $product_ids)
    {

    }

    /**
     * @param $product_id Product id or sku
     * @param $data
     * @return mixed
     */
    public function stockUpdate($product_id, $data)
    {
        
    }

}

/* End of file Inventory.php */