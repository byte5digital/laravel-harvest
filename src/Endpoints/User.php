<?php

namespace Naoray\LaravelHarvest\Endpoints;

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
        return \Naoray\LaravelHarvest\Models\User::class;
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