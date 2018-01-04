<?php

namespace Byte5\LaravelHarvest\Transformer;

use \Byte5\LaravelHarvest\Models\Client as ClientModel;
use Byte5\LaravelHarvest\Contracts\Transformer as TransformerContract;

class Client implements TransformerContract
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $client = new ClientModel;

        if (config('harvest.using_database')) {
            $client = $client->firstOrNew(['external_id' => $data['id']]);
        }

        $client->external_id = $data['id'];
        $client->currency = $data['currency'];
        $client->name = $data['name'];
        $client->is_active = $data['is_active'];
        $client->address = $data['address'];

        return $client;
    }
}