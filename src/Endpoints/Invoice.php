<?php

namespace Naoray\LaravelHarvest\Endpoints;

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
        return \Naoray\LaravelHarvest\Models\Invoice::class;
    }
}