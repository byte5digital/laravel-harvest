<?php

namespace Naoray\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model
{
    protected $dates = [
        'created_at', 'updated_at', 'spent_date', 'timer_started_at', ''
    ];
}