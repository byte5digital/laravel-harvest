<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;
use Byte5\LaravelHarvest\Traits\HasExternalRelations;

class Contact extends Model
{
    use HasExternalRelations;

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
    protected $externalRelations = ['client'];

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