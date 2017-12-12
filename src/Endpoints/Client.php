<?php

namespace Naoray\LaravelHarvest\Endpoints;

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
        return \Naoray\LaravelHarvest\Models\Client::class;
    }
}