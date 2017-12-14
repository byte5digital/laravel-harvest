<?php

namespace Naoray\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $dates = ['created_at', 'updated_at', 'spent_date'];
}