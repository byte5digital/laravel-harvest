<?php

namespace Naoray\LaravelHarvest\Transformer;

use Naoray\LaravelHarvest\Contracts\Transformer;
use \Naoray\LaravelHarvest\Models\TimeEntry as TimeEntryModel;

class TimeEntry implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $timeEntry = (new TimeEntryModel())->firstOrNew(['external_id' => $data['id']]);

        $timeEntry->external_id = $data['id'];
        $timeEntry->user = $data['user'];
        $timeEntry->user_assignment = $data['user_assignment'];
        $timeEntry->client = $data['client'];
        $timeEntry->project = $data['project'];
        $timeEntry->task = $data['task'];
        $timeEntry->task_assignment = $data['task_assignment'];
        $timeEntry->invoice = $data['invoice'];
        $timeEntry->reference = $data['reference'];
        $timeEntry->hours = $data['hours'];
        $timeEntry->billable_rate = $data['billable_rate'];
        $timeEntry->cost_rate = $data['cost_rate'];
        $timeEntry->notes = $data['notes'];
        $timeEntry->is_locked = $data['is_locked'];
        $timeEntry->locked_reason = $data['locked_reason'];
        $timeEntry->is_closed = $data['is_closed'];
        $timeEntry->is_billed = $data['is_billed'];
        $timeEntry->is_running = $data['is_running'];
        $timeEntry->billable = $data['billable'];
        $timeEntry->budgeted = $data['budgeted'];
        $timeEntry->started_time = $data['started_time'];
        $timeEntry->ended_time = $data['ended_time'];
        $timeEntry->spent_date = $data['spent_date'];
        $timeEntry->timer_started_at = $data['timer_started_at'];

        return $timeEntry;
    }
}