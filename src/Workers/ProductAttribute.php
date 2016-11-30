<?php

namespace Fv\Minions\Workers;

use Fv\Minions\Contracts\Worker\ProductAttributeInterface;

/**
 * Author       : Rifki Yandhi
 * Date Created : Aug 25, 2015 6:14:34 PM
 * File         : Product.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     :
 */
class ProductAttribute extends Worker implements ProductAttributeInterface
{

    public function getProductAttributeInfoByCode($code)
    {
        try
        {
            $response = $this->getClient()->get("products/attributes/{$code}");

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