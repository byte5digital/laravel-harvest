<?php

namespace Byte5\LaravelHarvest\Endpoints;

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
        return \Byte5\LaravelHarvest\Models\Contact::class;
    }
}