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

    /**
     * @param $id
     */
    public function client($id)
    {
        $this->params += ['client_id' => $id];
    }

    /**
     * @param $dateTime
     */
    public function updatedSince($dateTime)
    {
        if (! $dateTime instanceof Carbon) {
            $dateTime = Carbon::parse($dateTime);
        }

        $this->params += ['updated_since' => $dateTime->toIso8601ZuluString()];
    }
}
