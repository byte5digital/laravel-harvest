<?php

namespace Naoray\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    protected $dates = [
        'created_at', 'updated_at', 'issue_date', 'sent_at', 'accepted_at', 'declined_at'
    ];
}