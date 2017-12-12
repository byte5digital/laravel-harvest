<?php

namespace Naoray\LaravelHarvest\Endpoints;

class Role extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'roles';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Naoray\LaravelHarvest\Models\Role::class;
    }
}