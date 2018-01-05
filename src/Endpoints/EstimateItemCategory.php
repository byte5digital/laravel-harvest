<?php

namespace Byte5\LaravelHarvest\Endpoints;

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
        return \Byte5\LaravelHarvest\Models\EstimateItemCategory::class;
    }
}
