<?php

namespace Naoray\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model
{
    /**
     * @var array
     */
    protected $casts = [
        'reference' => 'object',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'spent_date', 'timer_started_at'
    ];

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * TimeEntry constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.time_entries')
        );
    }
}