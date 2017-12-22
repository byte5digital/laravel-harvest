<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer;
use \Byte5\LaravelHarvest\Models\Expense as ExpenseModel;

class Expense implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $expense = (new ExpenseModel())->firstOrNew(['external_id' => $data['id']]);

        $expense->external_id = $data['id'];
        $expense->client = $data['client'];
        $expense->project = $data['project'];
        $expense->expense_category = $data['expense_category'];
        $expense->user = $data['user'];
        $expense->invoice = $data['invoice'];
        $expense->receipt = $data['receipt'];
        $expense->notes = $data['notes'];
        $expense->billable = $data['billable'];
        $expense->is_closed = $data['is_closed'];
        $expense->is_locked = $data['is_locked'];
        $expense->is_billed = $data['is_billed'];
        $expense->locked_reason = $data['locked_reason'];
        $expense->spent_date = $data['spent_date'];

        return $expense;
    }
}