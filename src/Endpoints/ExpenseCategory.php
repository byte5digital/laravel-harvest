<?php

namespace Naoray\LaravelHarvest\Endpoints;

class Expense extends BaseEndpoint
{
    /**
     * @return mixed
     */
    protected function getPath()
    {
        return 'expense_categories';
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return \Naoray\LaravelHarvest\Models\ExpenseCategory::class;
    }
}