<?php

namespace Byte5\LaravelHarvest\Endpoints;

class Company extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'company';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Byte5\LaravelHarvest\Models\Company::class;
    }
}
