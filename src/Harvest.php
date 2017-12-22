<?php

namespace Byte5\LaravelHarvest;

use Illuminate\Support\Facades\Facade;

class Harvest extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'harvest';
    }
}