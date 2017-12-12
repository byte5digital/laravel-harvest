<?php

namespace Naoray\LaravelHarvest\Endpoints;

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
        return \Naoray\LaravelHarvest\Models\Company::class;
    }
}