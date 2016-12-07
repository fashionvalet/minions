<?php

namespace Fv\Minions\Workers;

use Fv\Minions\Contracts\Worker\OrderInvoiceInterface;
use GuzzleHttp\Exception\ClientException;

/**
 * Author       : Rifki Yandhi
 * Date Created : Nov 15, 2016 5:24:20 PM
 * File         : OrderInvoice.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     : 
 */
class OrderInvoice extends Worker implements OrderInvoiceInterface
{

    public function create($orderId, $items, $comment, $isNotify = false,
                           $isAppendComment = false)
    {
        try
        {
            $response = $this->client->post("order/{$orderId}/invoice", [
                'json' => [
                    'items'           => $items,
                    'comment'         => $comment,
                    'isNotify'        => $isNotify,
                    'isAppendComment' => $isAppendComment
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                $body = $response->getBody()->read(1024);
                return intval(ltrim($body, '"'));
            }
            else {
                return false;
            }
        }
        catch (ClientException $ex)
        {
            Log::error($ex->getMessage());
            return false;
        }
    }

}

/* End of file OrderInvoice.php */