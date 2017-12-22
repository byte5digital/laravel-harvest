<?php

namespace Byte5\LaravelHarvest\Endpoints;

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
        return \Byte5\LaravelHarvest\Models\Role::class;
    }
}