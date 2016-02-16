<?php

namespace Fv\Minions\Contracts\Worker;

interface InvoiceInterface
{

    public function getInvoices(array $filters);

    public function getInvoiceById($increment_id);

    public function createInvoice($order_increment_id, array $data);

    public function captureInvoice($increment_id);

    public function cancelInvoice($increment_id);

    public function addComment($increment_id, $comment, $email = false,
                               $include_comment = false);
}
