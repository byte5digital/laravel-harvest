<?php

namespace Byte5\LaravelHarvest\Endpoints;

class InvoiceItemCategory extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'invoice_item_categories';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Byte5\LaravelHarvest\Models\InvoiceItemCategory::class;
    }
}