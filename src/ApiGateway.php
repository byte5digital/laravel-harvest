<?php

namespace Naoray\LaravelHarvest;

use Zttp\Zttp;

class ApiGateway
{
    /**
     * @param $path
     * @return mixed
     */
    public function execute($path)
    {
        return Zttp::withHeaders([
            'Authorization' => 'Bearer '.config('harvest.api_key'),
            'Harvest-Account-Id' => config('harvest.account_id'),
        ])->get($path);
    }
}