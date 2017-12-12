<?php

namespace Naoray\LaravelHarvest\Endpoints;

class UserAssignment extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'projects/{id}/user_assignments';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Naoray\LaravelHarvest\Models\UserAssignment::class;
    }
}