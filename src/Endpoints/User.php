<?php

namespace Byte5\LaravelHarvest\Endpoints;

class User extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'users';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Byte5\LaravelHarvest\Models\User::class;
    }

    /**
     * @return mixed
     */
    public function me()
    {
        $this->buildUrl('/me');

        return $this->get();
    }
}