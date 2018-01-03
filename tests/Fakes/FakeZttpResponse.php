<?php

namespace Byte5\LaravelHarvest\Test\Fakes;

class FakeZttpResponse
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function json()
    {
        return $this->data;
    }
}