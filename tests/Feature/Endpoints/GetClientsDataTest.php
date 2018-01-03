<?php

namespace Byte5\LaravelHarvest\Test\Feature\Endpoints;

use Byte5\LaravelHarvest\Test\TestCase;

class GetClientsDataTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->harvest = app()->make('harvest');
    }

    /** @test **/
    function all_clients_can_be_received()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/clients', $this->harvest->getRequestUrl());
        });

        $this->harvest->clients->get();
    }

    /** @test **/
    function a_client_can_be_received_by_id()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/clients/12345', $this->harvest->getRequestUrl());
        });

        $this->harvest->clients->find('12345');
    }
}