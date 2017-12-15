<?php

namespace Naoray\LaravelHarvest\Transformer;

use Naoray\LaravelHarvest\Contracts\Transformer;
use \Naoray\LaravelHarvest\Models\InvoicePayment as InvoicePaymentModel;

class InvoicePayment implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $invoicePayment = (new InvoicePaymentModel())->firstOrNew(['external_id' => $data['id']]);

        $invoicePayment->external_id = $data['id'];
        $invoicePayment->payment_gateway_id = $data['payment_gateway_id'];
        $invoicePayment->amount = $data['amount'];
        $invoicePayment->recorded_by = $data['recorded_by'];
        $invoicePayment->recorded_by_email = $data['name'];
        $invoicePayment->notes = $data['notes'];
        $invoicePayment->transaction_id = $data['transaction_id'];
        $invoicePayment->paid_at = $data['paid_at'];

        return $invoicePayment;
    }
}