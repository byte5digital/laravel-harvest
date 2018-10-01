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
     * @param $id
     */
    public function user($id)
    {
        $this->params += ['user_id' => $id];
    }

    /**
     * @param $id
     */
    public function client($id)
    {
        $this->params += ['client_id' => $id];
    }

    /**
     * @param $id
     */
    public function project($id)
    {
        $this->params += ['project_id' => $id];
    }

    /**
     * @param $is_billed
     */
    public function isBilled($is_billed)
    {
        $this->params += ['is_billed' => $is_billed];
    }

    /**
     * @param $is_running
     */
    public function isRunning($is_running)
    {
        $this->params += ['is_running' => $is_running];
    }

    /**
     * @param $updated_since
     */
    public function updatedSince($updated_since)
    {
        $this->params += ['updated_since' => $updated_since];
    }

    /**
     * @param $from
     */
    public function from($from)
    {
        $this->params += ['from' => $from];
    }

    /**
     * @param $to
     */
    public function to($to)
    {
        $this->params += ['to' => $to];
    }



    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Byte5\LaravelHarvest\Models\TimeEntry::class;
    }
}
