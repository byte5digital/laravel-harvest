<?php

namespace Byte5\LaravelHarvest\Test\Feature\Endpoints;

use Byte5\LaravelHarvest\Test\TestCase;

class GetContactsDataTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->harvest = app()->make('harvest');
    }

    /** @test **/
    function all_contacts_can_be_received()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/contacts', $this->harvest->getRequestUrl());
        });

        $this->harvest->contacts->get();
    }

    /** @test **/
    function a_contact_can_be_received_by_id()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/contacts/12345', $this->harvest->getRequestUrl());
        });

        $this->harvest->contacts->find('12345');
    }
}