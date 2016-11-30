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

    public function getProductAttributeInfoByCode($code)
    {

    }

    public function getProductInfoById($productId, $storeView = null,
                                       $attributes = array(),
                                       $productIdentifierType = "")
    {

    }

    public function getProductInventoryStockItemListByIDs($productIds)
    {

    }

    public function getProductOptionsListById($productId, $storeId)
    {

    }

    public function getProducts(array $query = ['searchCriteria' => ['pageSize' => 100]])
    {
        try
        {
            $response = $this->getClient()->get("products", [
                'query' => $query
            ]);

            if ($response->getStatusCode() === 200) {
                return json_decode((string) $response->getBody());
            }
            else {
                return false;
            }
        }
        catch (\GuzzleHttp\Exception\ClientException $ex)
        {
            \Log::error($ex->getResponse()->getBody());
            return NULL;
        }
    }

    public function getProductBySku($sku, $query = array())
    {
        try
        {
            $response = $this->getClient()->get("products/{$sku}", [
                'query' => $query
            ]);

            if ($response->getStatusCode() === 200) {
                return json_decode((string) $response->getBody());
            }
            else {
                return false;
            }
        }
        catch (\GuzzleHttp\Exception\ClientException $ex)
        {
            \Log::error($ex->getResponse()->getBody());
            return NULL;
        }
    }

}

/* End of file Product.php */