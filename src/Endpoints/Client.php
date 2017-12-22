<?php

namespace Byte5\LaravelHarvest\Endpoints;

class Client extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'clients';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Byte5\LaravelHarvest\Models\Client::class;
    }
}