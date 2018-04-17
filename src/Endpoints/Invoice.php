<?php

namespace Byte5\LaravelHarvest\Endpoints;

use Carbon\Carbon;

class Invoice extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'invoices';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Byte5\LaravelHarvest\Models\Invoice::class;
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
     * @param $state
     */
    public function state($state)
    {
        $this->params += ['state' => $state];
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

    /**
     * @param $date
     */
    public function from($date)
    {
        if (! $date instanceof Carbon) {
            $date = Carbon::parse($date);
        }

        $this->params += ['from' => $date->format('Y-m-d')];
    }

    /**
     * @param $date
     */
    public function to($date)
    {
        if (! $date instanceof Carbon) {
            $date = Carbon::parse($date);
        }

        $this->params += ['to' => $date->format('Y-m-d')];
    }
}
