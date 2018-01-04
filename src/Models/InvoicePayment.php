<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class InvoicePayment extends Model
{
    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'paid_at'];

    /**
     * @var array
     */
    protected $fillable = [
        'external_id', 'payment_gateway_id', 'amount', 'recorded_by',
        'recorded_by_email', 'notes', 'transaction_id', 'paid_at',
    ];

    /**
     * InvoicePayment constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.invoice_payments')
        );
    }
}