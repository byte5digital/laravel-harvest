<?php

namespace Byte5\LaravelHarvest\Endpoints;

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
        return \Byte5\LaravelHarvest\Models\InvoiceMessage::class;
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