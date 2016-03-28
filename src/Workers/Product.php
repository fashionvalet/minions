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
        return $this->getSoapService()->call('catalogProductAttributeInfo', [$this->getSoapSession(), $code]);
    }

    public function getProductInfoById($productId, $storeView = null, $attributes = array(), $productIdentifierType = "")
    {
        return $this->getSoapService()->call('catalogProductInfo', [$this->getSoapSession(), $productId, $storeView, $attributes, $productIdentifierType]);
    }

    public function getProductInventoryStockItemListByIDs($productIds)
    {
        return $this->execute('catalogInventoryStockItemList', $productIds);
    }

    public function getProductOptionsListById($productId, $storeId)
    {
        return $this->execute('catalogProductCustomOptionList', $productId, $storeId);
    }

    public function createProduct($data)
    {
        // get attribute set
        $attributeSets = $this->execute('catalogProductAttributeSetList', []);
        $attributeSet = current($attributeSets);

        return $this->execute('catalogProductCreate', [$data['type'], $attributeSet->set_id, $data['sku'], $data]);
    }

    public function updateInventory($sku, $qty)
    {
        return $this->getSoapService()->call('catalogInventoryStockItemUpdate', [$this->getSoapSession(), $sku, [
            'qty' => $qty,
            'is_in_stock' => $qty > 0 ? 1 : 0
        ]]);
    }

}

/* End of file Product.php */