<?php

namespace Naoray\LaravelHarvest\Traits;

trait CanGuessEndpointNames
{
    /**
     * @var array
     */
    protected $availableEndpoints = [
        'Client',
        'Contact',
        'Company',
        'EstimateMessage',
        'EstimateItemCategory',
        'Estimate',
        'ExpenseCategory',
        'Expense',
        'InvoiceItemCategory',
        'InvoiceMessage',
        'InvoicePayment',
        'Invoice',
        'ProjectAssignment',
        'Project',
        'Role',
        'TaskAssignment',
        'Task',
        'TimeEntry',
        'User',
        'UserAssignment',
    ];

    /**
     * @param $name
     * @return mixed
     */
    protected function guessEndpointName($name)
    {
        return collect($this->availableEndpoints)->filter(function ($endpoint) use ($name) {
            return str_contains(str_singular($name), $endpoint);
        })->first();
    }
}