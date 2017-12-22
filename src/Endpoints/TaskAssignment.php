<?php

namespace Byte5\LaravelHarvest\Endpoints;

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
        return \Byte5\LaravelHarvest\Models\TaskAssignment::class;
    }
}