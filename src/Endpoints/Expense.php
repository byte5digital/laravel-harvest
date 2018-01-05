<?php

namespace Byte5\LaravelHarvest\Endpoints;

class Expense extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'expenses';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Byte5\LaravelHarvest\Models\Expense::class;
    }
}
