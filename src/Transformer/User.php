<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer;
use \Byte5\LaravelHarvest\Models\User as UserModel;

class User implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $user = new UserModel;

        if (config('harvest.using_database')) {
            $user = $user->firstOrNew(['external_id' => $data['id']]);
        }

        $user->external_id = $data['id'];
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->telephone = $data['telephone'];
        $user->timezone = $data['timezone'];
        $user->has_access_to_all_future_projects = $data['has_access_to_all_future_projects'];
        $user->is_contractor = $data['is_contractor'];
        $user->is_admin = $data['is_admin'];
        $user->is_project_manager = $data['is_project_manager'];
        $user->can_see_rates = $data['can_see_rates'];
        $user->can_create_projects = $data['can_create_projects'];
        $user->is_active = $data['is_active'];
        $user->weekly_capacity = $data['weekly_capacity'];
        $user->default_hourly_rate = $data['default_hourly_rate'];
        $user->cost_rate = $data['cost_rate'];
        $user->roles = $data['roles'];
        $user->avatar_url = $data['avatar_url'];

        return $user;
    }
}