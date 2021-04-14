<?php

namespace Byte5\LaravelHarvest\Traits;

trait CanResolveEndpoints
{
    /**
     * Resolve Endpoint name to endpoint class instance.
     *
     * @param $name
     * @return mixed
     */
    protected function resolveEndpoint($name)
    {
        $endpointClass = 'Byte5\LaravelHarvest\Endpoints\\'.$this->getEndpointName($name);

        if (! class_exists($endpointClass)) {
            throw new \RuntimeException("Endpoint $name does not exist!");
        }

        return new $endpointClass;
    }

    /**
     * Get Endpoint name.
     *
     * @param $name
     * @return mixed
     */
    private function getEndpointName($name)
    {
        return collect($this->availableEndpoints)->filter(function ($endpoint) use ($name) {
            return \Illuminate\Support\Str::singular(ucfirst($name)) == $endpoint;
        })->first();
    }

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
        'UserAssignment',
        'User',
    ];
}
