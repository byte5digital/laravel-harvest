<?php

namespace Byte5\LaravelHarvest\Endpoints;

class ExpenseCategory extends BaseEndpoint
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
        return \Byte5\LaravelHarvest\Models\ExpenseCategory::class;
    }
}
