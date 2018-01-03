<?php

namespace Byte5\LaravelHarvest\Endpoints;

class InvoicePayment extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'invoices/{INVOICE_ID}/payments';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Byte5\LaravelHarvest\Models\InvoicePayment::class;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function fromInvoice($id)
    {
        $this->baseId = $id;
    }
}