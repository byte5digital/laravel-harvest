<?php

namespace Byte5\LaravelHarvest\Endpoints;

class Project extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'projects';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Byte5\LaravelHarvest\Models\Project::class;
    }
}