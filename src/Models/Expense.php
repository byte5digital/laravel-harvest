<?php

namespace Naoray\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /**
     * @var array
     */
    protected $casts = [
        'receipt' => 'object',
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'spent_date'];

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * Expense constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.expenses')
        );
    }
}