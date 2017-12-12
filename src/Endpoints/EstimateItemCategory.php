<?php

namespace Naoray\LaravelHarvest\Endpoints;

class EstimateItemCategory extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'estimate_item_categories';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Naoray\LaravelHarvest\Models\EstimateItemCategory::class;
    }
}