<?php

namespace Fv\Minions\Workers;

use Fv\Minions\Contracts\Worker\InvoiceInterface;

/**
 * Author       : Rifki Yandhi
 * Date Created : Feb 16, 2016 10:43:51 AM
 * File         : Invoice.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     :
 */
class Invoice extends Worker implements InvoiceInterface
{

    public function addComment($increment_id, $comment, $email = false,
                               $include_comment = false)
    {

    }

    public function cancelInvoice($increment_id)
    {

    }

    public function captureInvoice($increment_id)
    {

    }

    public function createInvoice($order_increment_id, array $data)
    {

    }

    public function getInvoiceById($id)
    {
        try
        {
            $response = $this->getClient()->get("invoices/{$id}");

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

    public function getInvoices(array $query = ['searchCriteria' => ['pageSize' => 100]])
    {
        try
        {
            $response = $this->getClient()->get("invoices", [
                'query' => $query]);

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

    public function getInvoiceByIncrementId($incrementId)
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
            $response = $this->getClient()->get("invoices", [
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

/* End of file Invoice.php */
