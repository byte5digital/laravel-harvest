<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer;
use \Byte5\LaravelHarvest\Models\InvoiceMessage as InvoiceMessageModel;

class InvoiceMessage implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $invoiceMessage = new InvoiceMessageModel;

        if (config('harvest.uses_database')) {
            $invoiceMessage = $invoiceMessage->firstOrNew(['external_id' => $data['id']]);
        }

        $invoiceMessage->external_id = $data['id'];
        $invoiceMessage->sent_by = $data['sent_by'];
        $invoiceMessage->sent_by_email = $data['sent_by_email'];
        $invoiceMessage->sent_from = $data['sent_from'];
        $invoiceMessage->sent_from_email = $data['sent_from_email'];
        $invoiceMessage->recipients = $data['recipients'];
        $invoiceMessage->subject = $data['subject'];
        $invoiceMessage->body = $data['body'];
        $invoiceMessage->include_link_to_client_invoice = $data['include_link_to_client_invoice'];
        $invoiceMessage->attach_pdf = $data['attach_pdf'];
        $invoiceMessage->send_me_a_copy = $data['send_me_a_copy'];
        $invoiceMessage->thank_you = $data['thank_you'];
        $invoiceMessage->event_type = $data['event_type'];
        $invoiceMessage->reminder = $data['reminder'];
        $invoiceMessage->send_reminder_on = $data['send_reminder_on'];


        return $invoiceMessage;
    }
}