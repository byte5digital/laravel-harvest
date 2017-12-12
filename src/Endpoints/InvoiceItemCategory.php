<?php

namespace Naoray\LaravelHarvest\Endpoints;

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
        return \Naoray\LaravelHarvest\Models\InvoiceItemCategory::class;
    }
}