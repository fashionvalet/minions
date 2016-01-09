<?php namespace Fv\Minions\Workers;

class Invoice extends Worker
{
    public function getInvoices(array $filters)
    {
        return $this->execute('salesOrderInvoiceList', $filters);
    }

    public function getInvoiceInfo($increment_id)
    {
        return $this->execute('salesOrderInvoiceInfo', $increment_id);
    }
}