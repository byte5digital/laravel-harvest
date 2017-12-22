<?php

namespace Byte5\LaravelHarvest\Endpoints;

class Invoice extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'invoices';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Byte5\LaravelHarvest\Models\Invoice::class;
    }
}