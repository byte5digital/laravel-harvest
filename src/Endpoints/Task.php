<?php

namespace Naoray\LaravelHarvest\Endpoints;

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
        return \Naoray\LaravelHarvest\Models\Task::class;
    }
}