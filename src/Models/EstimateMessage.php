<?php

namespace Naoray\LaravelHarvest\Models;

class EstimateMessage extends BaseModel
{
    /**
     * @var array
     */
    protected $casts = [
        'recipients' => 'array',
        'send_me_a_copy' => 'boolean',
        'event_type' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $fillable = [
        'external_id', 'sent_by', 'sent_by_email', 'sent_from', 'recipients',
        'subject', 'body', 'send_me_a_copy', 'event_type',
    ];

    /**
     * EstimateMessage constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.estimate_messages')
        );
    }
}