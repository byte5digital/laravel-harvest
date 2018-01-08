<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;
use Byte5\LaravelHarvest\Traits\HasExternalRelations;

class UserAssignment extends Model
{
    use HasExternalRelations;

    /**
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'is_project_manager' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $fillable = [
        'external_id', 'user_id', 'is_active', 'is_project_manager', 'hourly_rate', 'budget',
    ];

    /**
     * UserAssignment constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.user_assignments')
        );
    }

    /**
     * @return array
     */
    protected function getExternalRelations()
    {
        return ['user'];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
