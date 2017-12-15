<?php

namespace Naoray\LaravelHarvest\Transformer;

use Naoray\LaravelHarvest\Contracts\Transformer;
use \Naoray\LaravelHarvest\Models\Client as ClientModel;

class Client implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $client = (new ClientModel())->firstOrNew(['external_id' => $data['id']]);

        $client->external_id = $data['id'];
        $client->currency = $data['currency'];
        $client->name = $data['name'];
        $client->is_active = $data['is_active'];
        $client->address = $data['address'];

        return $client;
    }
}