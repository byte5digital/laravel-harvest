<?php

namespace Naoray\LaravelHarvest\Transformer;

use Naoray\LaravelHarvest\Contracts\Transformer;
use \Naoray\LaravelHarvest\Models\EstimateItemCategory as EstimateItemCategoryModel;

class EstimateItemCategory implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $estimateItemCat = (new EstimateItemCategoryModel())->firstOrNew(['external_id' => $data['id']]);

        $estimateItemCat->external_id = $data['id'];
        $estimateItemCat->name = $data['name'];

        return $estimateItemCat;
    }
}