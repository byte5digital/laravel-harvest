<?php

namespace Naoray\LaravelHarvest\Endpoints;

class Contact extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'contacts';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Naoray\LaravelHarvest\Models\Contact::class;
    }
}