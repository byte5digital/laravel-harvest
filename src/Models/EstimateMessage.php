<?php

namespace Naoray\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class EstimateMessage extends Model
{
    /**
     * @var array
     */
    protected $casts = [
        'recipients' => 'array',
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * EstimateMessage constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.estimate_messages')
        );
    }
}