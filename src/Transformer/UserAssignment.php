<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer;
use \Byte5\LaravelHarvest\Models\UserAssignment as UserAssignmentModel;

class UserAssignment implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $userAssignment = new UserAssignmentModel;

        if (config('harvest.uses_database')) {
            $userAssignment = $userAssignment->firstOrNew(['external_id' => $data['id']]);
        }

        $userAssignment->external_id = $data['id'];
        $userAssignment->is_active = $data['is_active'];
        $userAssignment->is_project_manager = $data['is_project_manager'];
        $userAssignment->hourly_rate = $data['hourly_rate'];
        $userAssignment->budget = $data['budget'];

        $userAssignment->external_user_id = array_get($data, 'user.id');

        return $userAssignment;
    }
}