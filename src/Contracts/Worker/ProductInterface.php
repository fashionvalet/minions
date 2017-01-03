<?php

namespace Fv\Minions\Contracts\Worker;

/**
 * Author       : Rifki Yandhi
 * Date Created : Aug 25, 2015 6:15:11 PM
 * File         : ProductInterface.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     :
 */
interface ProductInterface
{

    public function getProducts(array $query = ['searchCriteria' => ['pageSize' => 100]]);

    public function getProductInfoById($productId, $storeView = null,
                                       $attributes = [],
                                       $productIdentifierType = "");

    public function getProductInventoryStockItemListByIDs($productIds);

    public function getProductOptionsListById($productId, $storeId);

    public function getProductAttributeInfoByCode($code);

    public function getProductBySku($sku, $query = []);

    public function updateStockQtyAndStatusBySku($sku, $stockItemId, $data);

    public function getProductInventoryBySku($sku);

    public function getChildProducts($parentSku);

    public function getProductMediaList($sku);
}

/* End of file ProductInterface.php */