<?php

namespace Byte5\LaravelHarvest\Models;

class EstimateItemCategory extends BaseModel
{
    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $fillable = ['external_id', 'name'];

    /**
     * EstimateItemCategory constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.estimate_item_categories')
        );
    }
}