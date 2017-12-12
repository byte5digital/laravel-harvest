<?php

namespace Naoray\LaravelHarvest\Endpoints;

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
        return \Naoray\LaravelHarvest\Models\InvoicePayment::class;
    }
}