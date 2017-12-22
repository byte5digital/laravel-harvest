<?php

namespace Byte5\LaravelHarvest\Endpoints;

class Task extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'tasks';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Byte5\LaravelHarvest\Models\Task::class;
    }
}