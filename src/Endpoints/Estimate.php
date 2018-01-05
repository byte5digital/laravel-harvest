<?php

namespace Byte5\LaravelHarvest\Endpoints;

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
        return \Byte5\LaravelHarvest\Models\Estimate::class;
    }
}
