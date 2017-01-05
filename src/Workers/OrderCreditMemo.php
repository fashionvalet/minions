<?php

namespace Fv\Minions\Workers;

use Fv\Minions\Contracts\Worker\OrderCreditMemoInterface;

class OrderCreditMemo extends Worker implements OrderCreditMemoInterface
{

    public function getOrderCreditMemo($id)
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
        catch (\GuzzleHttp\Exception\ClientException $ex)
        {
            \Log::error($ex->getResponse()->getBody());
            return NULL;
        }
    }

    public function getOrderCreditMemos(array $query = ['searchCriteria' => ['pageSize' => 100]])
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
        catch (\GuzzleHttp\Exception\ClientException $ex)
        {
            \Log::error($ex->getResponse()->getBody());
            return NULL;
        }
    }

    public function createOrderCreditMemo(array $data)
    {
        try
        {
            $response = $this->getClient()->post("creditmemo", $data);

            if ($response->getStatusCode() === 200) {
                $body = $response->getBody()->read(1024);
                return intval(ltrim($body, '"'));
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

    public function addOrderCreditMemoComment($id, $comment = '',
                                              $isNotify = false,
                                              $isVisibleFrontend = false)
    {
        try
        {
            $response = $this->getClient()->post("creditmemo/{$id}/comments", [
                'comment'            => $comment,
                'isCustomerNotified' => $isNotify,
                'isVisibleOnFront'   => $isVisibleFrontend
            ]);

            if ($response->getStatusCode() === 200) {
                return true;
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

    public function cancelOrderCreditMemo($id)
    {
        try
        {
            $response = $this->getClient()->put("creditmemo/{$id}");

            if ($response->getStatusCode() === 200) {
                return true;
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
