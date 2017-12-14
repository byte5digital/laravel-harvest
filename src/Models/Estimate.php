<?php

namespace Naoray\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    /**
     * @var array
     */
    protected $casts = [
        'line_items' => 'array',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'issue_date', 'sent_at', 'accepted_at', 'declined_at'
    ];

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Estimate constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.estimates')
        );
    }
}