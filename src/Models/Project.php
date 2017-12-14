<?php

namespace Naoray\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'over_budget_notification_date', 'starts_on', 'ends_on'
    ];

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Project constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.projects')
        );
    }
}