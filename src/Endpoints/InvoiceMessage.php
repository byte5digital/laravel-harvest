<?php

namespace Naoray\LaravelHarvest\Endpoints;

class InvoiceMessage extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'invoices/{INVOICE_ID}/messages';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Naoray\LaravelHarvest\Models\InvoiceMessage::class;
    }
}