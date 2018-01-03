<?php

namespace Byte5\LaravelHarvest\Endpoints;

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
        return \Byte5\LaravelHarvest\Models\ProjectAssignment::class;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getFromUser($id)
    {
        $this->baseId = $id;

        $this->buildUrl();

        return $this->getUrl();
    }
}