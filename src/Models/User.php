<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * @var array
     */
    protected $casts = [
        'roles' => 'array',
        'has_access_to_all_future_projects' => 'boolean',
        'is_contractor' => 'boolean',
        'is_admin' => 'boolean',
        'is_project_manager' => 'boolean',
        'can_see_rates' => 'boolean',
        'can_create_projects' => 'boolean',
        'can_create_invoices' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $fillable = [
        'external_id', 'first_name', 'last_name', 'email', 'telephone', 'timezone',
        'has_access_to_all_future_projects', 'is_contractor', 'is_admin',
        'is_project_manager', 'can_see_rates', 'can_create_projects',
        'is_active', 'weekly_capacity', 'default_hourly_rate',
        'cost_rate', 'roles', 'avatar_url',
    ];

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
