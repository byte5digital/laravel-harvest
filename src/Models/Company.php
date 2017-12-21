<?php

namespace Naoray\LaravelHarvest\Models;

class Company extends BaseModel
{
    /**
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'wants_timestamp_timers' => 'boolean',
        'expense_feature' => 'boolean',
        'invoice_feature' => 'boolean',
        'estimate_feature' => 'boolean',
        'approval_feature' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'base_uri', 'full_domain', 'name', 'is_active', 'week_start_day',
        'wants_timestamp_timers', 'wants_timestamp_timers', 'time_format',
        'plan_type', 'clock', 'decimal_symbol', 'thousands_separator',
        'color_scheme', 'expense_feature', 'invoice_feature',
        'estimate_feature', 'approval_feature'
    ];

    /**
     * Company constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.companies')
        );
    }
}