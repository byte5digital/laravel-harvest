<?php

namespace Naoray\LaravelHarvest\Transformer;

use Naoray\LaravelHarvest\Contracts\Transformer;
use \Naoray\LaravelHarvest\Models\EstimateMessage as EstimateMessageModel;

class EstimateMessage implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $estimateMessage = (new EstimateMessageModel())->firstOrNew(['external_id' => $data['id']]);

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