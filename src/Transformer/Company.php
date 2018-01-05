<?php

namespace Byte5\LaravelHarvest\Transformer;

use \Byte5\LaravelHarvest\Models\Company as CompanyModel;
use Byte5\LaravelHarvest\Contracts\Transformer as TransformerContract;

class Company implements TransformerContract
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $company = new CompanyModel;

        if (config('harvest.uses_database')) {
            $company = $company->firstOrNew(['full_domain' => $data['full_domain']]);
        }

        $company->base_uri = $data['base_uri'];
        $company->full_domain = $data['full_domain'];
        $company->name = $data['name'];
        $company->is_active = $data['is_active'];
        $company->week_start_day = $data['week_start_day'];
        $company->wants_timestamp_timers = $data['wants_timestamp_timers'];
        $company->wants_timestamp_timers = $data['wants_timestamp_timers'];
        $company->time_format = $data['time_format'];
        $company->plan_type = $data['plan_type'];
        $company->clock = $data['clock'];
        $company->decimal_symbol = $data['decimal_symbol'];
        $company->thousands_separator = $data['thousands_separator'];
        $company->color_scheme = $data['color_scheme'];
        $company->expense_feature = $data['expense_feature'];
        $company->invoice_feature = $data['invoice_feature'];
        $company->estimate_feature = $data['estimate_feature'];
        $company->approval_feature = array_get($data, 'approval_feature', null);

        return $company;
    }
}