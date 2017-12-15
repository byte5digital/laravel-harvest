<?php

namespace Naoray\LaravelHarvest\Transformer;

use Naoray\LaravelHarvest\Contracts\Transformer;
use \Naoray\LaravelHarvest\Models\Estimate as EstimateModel;

class Estimate implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $estimate = (new EstimateModel())->firstOrNew(['external_id' => $data['id']]);

        $estimate->external_id = $data['id'];
        $estimate->creator = $data['creator'];
        $estimate->line_items = $data['line_items'];
        $estimate->client_key = $data['client_key'];
        $estimate->number = $data['number'];
        $estimate->purchase_order = $data['purchase_order'];
        $estimate->amount = $data['amount'];
        $estimate->tax = $data['tax'];
        $estimate->tax_amount = $data['tax_amount'];
        $estimate->tax2 = $data['tax2'];
        $estimate->tax2_amount = $data['tax2_amount'];
        $estimate->discount = $data['discount'];
        $estimate->discount_amount = $data['discount_amount'];
        $estimate->subject = $data['subject'];
        $estimate->notes = $data['notes'];
        $estimate->currency = $data['currency'];
        $estimate->issue_date = $data['issue_date'];
        $estimate->sent_at = $data['sent_at'];
        $estimate->accepted_at = $data['accepted_at'];
        $estimate->declined_at = $data['declined_at'];
        $estimate->discount_amount = $data['discount_amount'];
        $estimate->client = $data['client'];

        return $estimate;
    }
}