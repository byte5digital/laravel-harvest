<?php

namespace Naoray\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $dates = [
        'created_at', 'updated_at', 'period_start', 'period_end', 'issue_date', 'due_date', 'sent_at', 'paid_at', 'closed_at'
    ];
}