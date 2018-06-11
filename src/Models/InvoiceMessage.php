<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceMessage extends Model
{
    /**
     * @var array
     */
    protected $casts = [
        'recipients' => 'array',
        'include_link_to_client_invoice' => 'boolean',
        'attach_pdf' => 'boolean',
        'send_me_a_copy' => 'boolean',
        'thank_you' => 'boolean',
        'reminder' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $fillable = [
        'external_id', 'sent_by', 'sent_by_email', 'sent_from', 'sent_from_email',
        'recipients', 'subject', 'body', 'include_link_to_client_invoice',
        'attach_pdf', 'send_me_a_copy', 'thank_you', 'event_type',
        'reminder', 'send_reminder_on',
    ];

    /**
     * InvoiceMessage constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.invoice_messages')
        );
    }
}
