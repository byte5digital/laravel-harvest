<?php

namespace Naoray\LaravelHarvest\Models;

class InvoiceItemCategory extends BaseModel
{
    /**
     * @var array
     */
    protected $casts = [
        'use_as_service' => 'boolean',
        'use_as_expense' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $fillable = [
        'external_id', 'name', 'use_as_expense', 'use_as_service'
    ];

    /**
     * InvoiceItemCategory constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.invoice_item_categories')
        );
    }
}