<?php

namespace Byte5\LaravelHarvest\Transformer;

use Byte5\LaravelHarvest\Contracts\Transformer;
use \Byte5\LaravelHarvest\Models\EstimateMessage as EstimateMessageModel;

class EstimateMessage implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $estimateMessage = new EstimateMessageModel;

        if (config('harvest.uses_database')) {
            $estimateMessage = $estimateMessage->firstOrNew(['external_id' => $data['id']]);
        }

        $estimateMessage->external_id = $data['id'];
        $estimateMessage->sent_by = $data['sent_by'];
        $estimateMessage->sent_by_email = $data['sent_by_email'];
        $estimateMessage->sent_from = $data['sent_from'];
        $estimateMessage->recipients = $data['recipients'];
        $estimateMessage->subject = $data['subject'];
        $estimateMessage->body = $data['body'];
        $estimateMessage->send_me_a_copy = $data['send_me_a_copy'];
        $estimateMessage->event_type = $data['event_type'];

        return $estimateMessage;
    }
}