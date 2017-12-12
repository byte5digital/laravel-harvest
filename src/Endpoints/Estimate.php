<?php

namespace Naoray\LaravelHarvest\Endpoints;

class Estimate extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'estimates';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Naoray\LaravelHarvest\Models\Estimate::class;
    }
}