<?php

namespace Fv\Minions\Workers;

use Fv\Minions\Contracts\Worker\OrderCommentInterface;

/**
 * Author       : Rifki Yandhi
 * Date Created : Nov 15, 2016 4:54:20 PM
 * File         : OrderComment.php
 * Copyright    : rifkiyandhi@gmail.com
 * Function     : 
 */
class OrderComment extends Worker implements OrderCommentInterface
{

    public function create($orderId, $data)
    {
        try
        {
            $response = $this->client->post("orders/{$orderId}/comments", [
                'json' => [
                    'statusHistory' => $data
                ]
            ]);

            if ($response->getStatusCode() === 200) {
                return $response->getBody()->read(1024);
            }
            else {
                return false;
            }
        }
        catch (Exception $ex)
        {
            \Log::error($ex->getMessage());
        }
    }

}

/* End of file OrderComment.php */