<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;
use Byte5\LaravelHarvest\Traits\HasExternalRelations;

class ProjectAssignment extends Model
{
    use HasExternalRelations;

    /**
     * @var array
     */
    protected $casts = [
        'task_assignments' => 'array',
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
        'external_id', 'project_id', 'client_id', 'is_active', 'is_project_manager',
        'hourly_rate', 'budget', 'task_assignments',
    ];

    /**
     * ProjectAssignment constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.project_assignments')
        );
    }

    /**
     * @return array
     */
    protected function getExternalRelations()
    {
        return ['project', 'client'];
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
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}