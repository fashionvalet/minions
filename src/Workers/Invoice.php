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
        return $this->getSoapService()->call('salesOrderInvoiceAddComment', [
                    $this->getSoapSession(),
                    $increment_id,
                    $comment,
                    $email,
                    $include_comment
        ]);
    }

    public function cancelInvoice($increment_id)
    {
        return $this->execute('salesOrderInvoiceCancel', $increment_id);
    }

    public function captureInvoice($increment_id)
    {
        return $this->execute('salesOrderInvoiceCapture', $increment_id);
    }

    public function createInvoice($order_increment_id, array $data)
    {
        return $this->getSoapService()->call('salesOrderInvoiceCreate', [
                    $this->getSoapSession(),
                    $order_increment_id,
                    $data
        ]);
    }

    public function getInvoiceById($increment_id)
    {
        return $this->execute('salesOrderInvoiceInfo', $increment_id);
    }

    public function getInvoices(array $filters)
    {
        return $this->execute('salesOrderInvoiceList', $filters);
    }

}

/* End of file Invoice.php */