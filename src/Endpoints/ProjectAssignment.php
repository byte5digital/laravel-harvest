<?php

namespace Naoray\LaravelHarvest\Endpoints;

class ProjectAssignment extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'users/{USER_ID}/project_assignments';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Naoray\LaravelHarvest\Models\ProjectAssignment::class;
    }
}