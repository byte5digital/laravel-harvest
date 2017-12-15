<?php

namespace Naoray\LaravelHarvest\Transformer;

use Naoray\LaravelHarvest\Contracts\Transformer;
use \Naoray\LaravelHarvest\Models\Contact as ContactModel;

class Contact implements Transformer
{
    /**
     * @param $data
     * @return mixed
     */
    public function transformModelAttributes($data)
    {
        $contact = (new ContactModel())->firstOrNew(['external_id' => $data['id']]);

        $contact->external_id = $data['id'];
        $contact->title = $data['title'];
        $contact->first_name = $data['first_name'];
        $contact->last_name = $data['last_name'];
        $contact->email = $data['email'];
        $contact->phone_office = $data['phone_office'];
        $contact->phone_mobile = $data['phone_mobile'];
        $contact->fax = $data['fax'];
        $contact->client = $data['client'];

        return $contact;
    }
}