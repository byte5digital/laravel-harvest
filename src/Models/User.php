<?php

namespace Naoray\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * @var array
     */
    protected $casts = [
        'roles' => 'array'
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * User constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.users')
        );
    }
}