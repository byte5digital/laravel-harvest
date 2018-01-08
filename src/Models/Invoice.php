<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;
use Byte5\LaravelHarvest\Traits\HasExternalRelations;

class Invoice extends Model
{
    use HasExternalRelations;

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
        'issue_date', 'due_date', 'sent_at', 'paid_at', 'closed_at',
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
     * @return array
     */
    protected function getExternalRelations()
    {
        return [
            'client',
            'estimate',
            'creator' => 'user',
        ];
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
     * Get invoice's expenses.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
