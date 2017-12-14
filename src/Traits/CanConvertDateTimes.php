<?php

namespace Naoray\LaravelHarvest\Traits;

use Carbon\Carbon;
use Illuminate\Support\Collection;

trait CanConvertDateTimes
{
    protected $carbonParseable = [
        'accepted_at',
        'closed_at',
        'created_at',
        'declined_at',
        'due_date',
        'ends_on',
        'issue_date',
        'over_budget_notification_date',
        'paid_at',
        'period_end',
        'period_start',
        'sent_at',
        'spent_date',
        'starts_on',
        'timer_started_at',
        'updated_at',
    ];

    /**
     * Converts all known datetime fields into Carbon instances
     *
     * @param $data
     * @return Illuminate\Support\Collection
     */
    protected function convertDateTimes($data)
    {
        if (! $data instanceof Collection) {
            $data = collect($data);
        }

        return $data->map(function ($item) {
            foreach ($this->carbonParseable as $parseable) {
                if (array_has($item, $parseable)) {
                    $item[$parseable] = Carbon::parse($item[$parseable]);
                }
            }

            return $item;
        });
    }
}