<?php

namespace Naoray\LaravelHarvest\Transformer;

use Naoray\LaravelHarvest\Contracts\Transformer;
use \Naoray\LaravelHarvest\Models\ExpenseCategory as ExpenseCategoryModel;

class ExpenseCategory implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $expenseCategory = (new ExpenseCategoryModel())->firstOrNew(['external_id' => $data['id']]);

        $expenseCategory->external_id = $data['id'];
        $expenseCategory->name = $data['name'];
        $expenseCategory->unit_name = $data['unit_name'];
        $expenseCategory->unit_price = $data['unit_price'];
        $expenseCategory->is_active = $data['is_active'];

        return $expenseCategory;
    }
}