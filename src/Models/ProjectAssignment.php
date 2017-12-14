<?php

namespace Naoray\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectAssignment extends Model
{
    /**
     * @var array
     */
    protected $casts = [
        'task_assignments' => 'array'
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
}