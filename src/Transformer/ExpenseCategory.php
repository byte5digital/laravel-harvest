<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer;
use Byte5\LaravelHarvest\Models\ExpenseCategory as ExpenseCategoryModel;

class ExpenseCategory implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $expenseCategory = new ExpenseCategoryModel;

        if (config('harvest.uses_database')) {
            $expenseCategory = $expenseCategory->firstOrNew(['external_id' => $data['id']]);
        }

        $expenseCategory->external_id = $data['id'];
        $expenseCategory->name = $data['name'];
        $expenseCategory->unit_name = $data['unit_name'];
        $expenseCategory->unit_price = $data['unit_price'];
        $expenseCategory->is_active = $data['is_active'];

        return $expenseCategory;
    }
}
