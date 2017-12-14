<?php

namespace Naoray\LaravelHarvest\Models;

use Illuminate\Database\Eloquent\Model;

class InvoicePayment extends Model
{
    protected $dates = ['created_at', 'updated_at', 'paid_at'];
}