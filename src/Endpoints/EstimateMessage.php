<?php

namespace Byte5\LaravelHarvest\Endpoints;

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
        return \Byte5\LaravelHarvest\Models\EstimateMessage::class;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function fromEstimate($id)
    {
        $this->baseId = $id;
    }
}