<?php

namespace Naoray\LaravelHarvest\Models;

class Contact extends BaseModel
{
    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $fillable = [
        'external_id', 'title', 'first_name', 'last_name', 'email',
        'phone_office', 'phone_mobile', 'fax', 'client_id'
    ];

    /**
     * @var array
     */
    protected $transformable = [
        'client' => 'relation',
    ];

    /**
     * Contact constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.contacts')
        );
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}