<?php

namespace Naoray\LaravelHarvest\Models;

class TaskAssignment extends BaseModel
{
    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $fillable = [
        'external_id', 'task_id', 'is_active', 'hourly_rate', 'budget',
    ];

    /**
     * @var array
     */
    protected $transformable = [
        'task' => 'relation',
    ];

    /**
     * TaskAssignment constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.task_assignments')
        );
    }

    /**
     * @return mixed
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}