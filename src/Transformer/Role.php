<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer;
use \Byte5\LaravelHarvest\Models\Role as RoleModel;

class Role implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $role = new RoleModel;

        if (config('harvest.uses_database')) {
            $role = $role->firstOrNew(['external_id' => $data['id']]);
        }

        $role->external_id = $data['id'];
        $role->name = $data['name'];
        $role->user_ids = $data['user_ids'];

        return $role;
    }
}