<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer;
use \Byte5\LaravelHarvest\Models\TaskAssignment as TaskAssignmentModel;

class TaskAssignment implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $taskAssignment = (new TaskAssignmentModel())->firstOrNew(['external_id' => $data['id']]);

        $taskAssignment->external_id = $data['id'];
        $taskAssignment->task = $data['task'];
        $taskAssignment->is_active = $data['is_active'];
        $taskAssignment->hourly_rate = $data['hourly_rate'];
        $taskAssignment->budget = $data['budget'];

        return $taskAssignment;
    }
}