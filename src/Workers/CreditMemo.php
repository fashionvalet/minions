<?php

namespace Fv\Minions\Workers;

use Fv\Minions\Contracts\Worker\CreditMemoInterface;
use GuzzleHttp\Exception\ClientException;

/**
 * Author       : Rifki Yandhi
 * Date Created : Nov 15, 2016 5:24:20 PM
 * File         : CreditMemo.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     : 
 */
class CreditMemo extends Worker implements CreditMemoInterface
{

    public function create($orderId, $invoiceId, $data)
    {

    }

    public function getCreditMemoById($id)
    {
        try
        {
            $response = $this->getClient()->get("creditmemo/{$id}");

            if ($response->getStatusCode() === 200) {
                return json_decode((string) $response->getBody());
            }
            else {
                return false;
            }
        }
        catch (ClientException $ex)
        {
            \Log::error($ex->getResponse()->getBody());
            return NULL;
        }
    }

    public function getCreditMemos(array $query = ['searchCriteria' => ['pageSize' => 100]])
    {
        try
        {
            $response = $this->getClient()->get("creditmemos", [
                'query' => $query
            ]);

            if ($response->getStatusCode() === 200) {
                return json_decode((string) $response->getBody());
            }
            else {
                return false;
            }
        }
        catch (ClientException $ex)
        {
            \Log::error($ex->getResponse()->getBody());
            return NULL;
        }
    }

}

/* End of file CreditMemo.php */