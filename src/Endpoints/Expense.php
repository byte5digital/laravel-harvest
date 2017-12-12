<?php

namespace Naoray\LaravelHarvest\Endpoints;

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
        return \Naoray\LaravelHarvest\Models\Expense::class;
    }
}