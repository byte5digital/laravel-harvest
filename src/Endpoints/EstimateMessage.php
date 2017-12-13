<?php

namespace Naoray\LaravelHarvest\Endpoints;

class EstimateMessage extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'estimates/{estimate_ID}/messages';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Naoray\LaravelHarvest\Models\EstimateMessage::class;
    }
}