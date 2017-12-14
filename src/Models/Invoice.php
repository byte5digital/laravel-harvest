<?php

namespace Naoray\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
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
        'created_at', 'updated_at', 'period_start', 'period_end',
        'issue_date', 'due_date', 'sent_at', 'paid_at', 'closed_at'
    ];

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Invoice constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.invoices')
        );
    }
}