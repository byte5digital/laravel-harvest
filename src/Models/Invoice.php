<?php

namespace Naoray\LaravelHarvest\Models;

class Invoice extends BaseModel
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
    protected $fillable = [
        'external_id', 'client_id', 'estimate_id', 'retainer_id', 'creator_id', 'line_items',
        'client_key', 'number', 'purchase_order', 'amount', 'due_amount', 'tax', 'tax_amount',
        'tax2', 'tax2_amount', 'discount', 'discount_amount', 'subject', 'notes', 'currency',
        'period_start', 'period_end', 'issue_date', 'due_date', 'sent_at', 'paid_at', 'closed_at',
    ];

    /**
     * @var array
     */
    protected $transformable = [
        'client' => 'relation',
        'estimate' => 'relation',
//        'retainer' => 'relation',
//        'creator' => 'relation',
    ];

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

    /**
     * @return mixed
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * @return mixed
     */
    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return mixed
     */
    public function estimate()
    {
        return $this->belongsTo(Estimate::class);
    }

    /**
     * @return mixed
     */
    public function retainer()
    {
        return $this->belongsTo(Client::class);
    }
}