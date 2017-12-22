<?php

namespace Byte5\LaravelHarvest\Endpoints;

class TimeEntry extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'time_entries';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Byte5\LaravelHarvest\Models\TimeEntry::class;
    }
}