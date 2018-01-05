<?php

namespace Byte5\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;
use Byte5\LaravelHarvest\Traits\HasExternalRelations;

class TimeEntry extends Model
{
    use HasExternalRelations;

    /**
     * @var array
     */
    protected $casts = [
        'reference' => 'object',
        'is_locked' => 'boolean',
        'is_closed' => 'boolean',
        'is_billed' => 'boolean',
        'is_running' => 'boolean',
        'billable' => 'boolean',
        'budgeted' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'spent_date', 'timer_started_at',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'external_id', 'user_id', 'user_assignment_id', 'client_id', 'project_id', 'task_id',
        'task_assignment_id', 'invoice_id', 'reference', 'hours', 'billable_rate', 'cost_rate',
        'notes', 'is_locked', 'locked_reason', 'is_closed', 'is_billed', 'is_running',
        'billable', 'budgeted', 'started_time', 'ended_time', 'spent_date',
        'timer_started_at',
    ];

    /**
     * TimeEntry constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(
            config('harvest.table_prefix').config('harvest.table_names.time_entries')
        );
    }

    /**
     * @return array
     */
    protected function getExternalRelations()
    {
        return [
            'user',
            'client',
            'invoice',
            'project',
            'task',
            'taskAssignment',
            'userAssignment',
        ];
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
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * @return mixed
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return mixed
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * @return mixed
     */
    public function taskAssignment()
    {
        return $this->belongsTo(TaskAssignment::class);
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return mixed
     */
    public function userAssignment()
    {
        return $this->belongsTo(UserAssignment::class);
    }
}
