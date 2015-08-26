<?php

namespace Fv\Minions\Workers;

use Fv\Minions\Contracts\Worker\ProductInterface;

/**
 * Author       : Rifki Yandhi
 * Date Created : Aug 25, 2015 6:14:34 PM
 * File         : Product.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     : 
 */
class Product extends Worker implements ProductInterface
{

    public function getProducts(array $filters)
    {
        return $this->execute('catalogProductList', $filters);
    }

    public function getProductAttributeInfoByCode($code)
    {
        return $this->getSoapService()->call('catalogProductAttributeInfo', [$this->getSession(), $code]);
    }

    public function getProductInfoById($productId, $storeView = null, $attributes = array(), $productIdentifierType = "")
    {
        return $this->getSoapService()->call('catalogProductInfo', [$this->getSession(), $productId, $storeView, $attributes, $productIdentifierType]);
    }

    public function getProductInventoryStockItemListByIDs($productIds)
    {
        return $this->execute('catalogInventoryStockItemList', $productIds);
    }

    public function getProductOptionsListById($productId, $storeId)
    {
        return $this->execute('catalogProductCustomOptionList', $productId, $storeId);
    }

}

/* End of file Product.php */