<?php

namespace Fv\Minions\Workers;

use Fv\Minions\Contracts\Worker\OrderInterface;

class Order extends Worker implements OrderInterface
{

    public function getNewOrders(array $filters)
    {

    }

    public function getOrderById($id)
    {
        try
        {
            $response = $this->getClient()->get("orders/{$id}");

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

    public function addCommentToOrder($incrementId, $status, $comment = null,
                                      $notify = false)
    {

    }

    public function cancelOrder($id)
    {
        try
        {
            $response = $this->client->post("order/{$id}/cancel");

            if ($response->getStatusCode() === 200) {
                return true;
            }
            else {
                return false;
            }
        }
        catch (ClientException $ex)
        {
            \Log::error($ex->getMessage());
            return false;
        }
    }

    public function holdOrder($id)
    {
        try
        {
            $response = $this->client->post("order/{$id}/hold");

            if ($response->getStatusCode() === 200) {
                return true;
            }
            else {
                return false;
            }
        }
        catch (ClientException $ex)
        {
            \Log::error($ex->getMessage());
            return false;
        }
    }

    public function unholdOrder($id)
    {
        try
        {
            $response = $this->client->post("order/{$id}/unhold");

            if ($response->getStatusCode() === 200) {
                return true;
            }
            else {
                return false;
            }
        }
        catch (ClientException $ex)
        {
            \Log::error($ex->getMessage());
            return false;
        }
    }

    public function getOrders(array $query = ['searchCriteria' => ['pageSize' => 100]])
    {
        try
        {
            $response = $this->getClient()->get("orders", [
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

    public function getOrderByIncrementId($incrementId)
    {
        $query['searchCriteria'] = [
            'filter_groups' => [
                [
                    'filters' => [
                        [
                            'field'         => 'increment_id',
                            'value'         => $incrementId,
                            'conditionType' => 'eq'
                        ]
                    ]
                ]
            ]
        ];

        try
        {
            $response = $this->getClient()->get("orders", [
                'query' => $query
            ]);

            if ($response->getStatusCode() === 200) {
                $data = json_decode((string) $response->getBody());
                if ($data && isset($data->items)) {
                    return current($data->items);
                }
                else {
                    return false;
                }
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
