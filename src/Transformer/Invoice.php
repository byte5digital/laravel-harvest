<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer;
use \Byte5\LaravelHarvest\Models\Invoice as InvoiceModel;

class Invoice implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $invoice = (new InvoiceModel())->firstOrNew(['external_id' => $data['id']]);

        $invoice->external_id = $data['id'];
//        $invoice->retainer = $data['retainer'];
        $invoice->line_items = $data['line_items'];
        $invoice->client_key = $data['client_key'];
        $invoice->number = $data['number'];
        $invoice->purchase_order = $data['purchase_order'];
        $invoice->amount = $data['amount'];
        $invoice->due_amount = $data['due_amount'];
        $invoice->tax = $data['tax'];
        $invoice->tax_amount = $data['tax_amount'];
        $invoice->tax2 = $data['tax2'];
        $invoice->tax2_amount = $data['tax2_amount'];
        $invoice->discount = $data['discount'];
        $invoice->discount_amount = $data['discount_amount'];
        $invoice->subject = $data['subject'];
        $invoice->notes = $data['notes'];
        $invoice->currency = $data['currency'];
        $invoice->period_start = $data['period_start'];
        $invoice->period_end = $data['period_end'];
        $invoice->issue_date = $data['issue_date'];
        $invoice->due_date = $data['due_date'];
        $invoice->sent_at = $data['sent_at'];
        $invoice->paid_at = $data['paid_at'];
        $invoice->closed_at = $data['closed_at'];

        $invoice->external_client_id = $data['client'];
        $invoice->external_creator_id = $data['creator'];
        $invoice->external_estimate_id = $data['estimate'];

        return $invoice;
    }
}