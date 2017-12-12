<?php

namespace Naoray\LaravelHarvest\Endpoints;

class TaskAssignment extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'projects/{id}/task_assignments';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Naoray\LaravelHarvest\Models\TaskAssignment::class;
    }
}