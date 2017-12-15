<?php

namespace Naoray\LaravelHarvest\Transformer;

use Naoray\LaravelHarvest\Contracts\Transformer;
use \Naoray\LaravelHarvest\Models\Role as RoleModel;

class Role implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $role = (new RoleModel())->firstOrNew(['external_id' => $data['id']]);

        $role->external_id = $data['id'];
        $role->name = $data['name'];
        $role->user_ids = $data['user_ids'];

        return $role;
    }
}