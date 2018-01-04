<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer;
use \Byte5\LaravelHarvest\Models\Project as ProjectModel;

class Project implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $project = (new ProjectModel())->firstOrNew(['external_id' => $data['id']]);

        $project->external_id = $data['id'];
        $project->name = $data['name'];
        $project->code = $data['code'];
        $project->is_active = $data['is_active'];
        $project->is_billable = $data['is_billable'];
        $project->is_fixed_fee = $data['is_fixed_fee'];
        $project->bill_by = $data['bill_by'];
        $project->hourly_rate = $data['hourly_rate'];
        $project->budget = $data['budget'];
        $project->budget_by = $data['budget_by'];
        $project->notify_when_over_budget = $data['notify_when_over_budget'];
        $project->over_budget_notification_percentage = $data['over_budget_notification_percentage'];
        $project->show_budget_to_all = $data['show_budget_to_all'];
        $project->cost_budget = $data['cost_budget'];
        $project->cost_budget_include_expenses = $data['cost_budget_include_expenses'];
        $project->fee = $data['fee'];
        $project->notes = $data['notes'];
        $project->starts_on = $data['starts_on'];
        $project->ends_on = $data['ends_on'];
        $project->over_budget_notification_date = $data['over_budget_notification_date'];

        $project->external_client_id = array_get($data, 'client.id');

        return $project;
    }
}