<?php

namespace Naoray\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $dates = [
        'created_at', 'updated_at', 'over_budget_notification_date', 'starts_on', 'ends_on'
    ];
}