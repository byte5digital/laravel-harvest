<?php

namespace Byte5\LaravelHarvest\Test\Feature\Endpoints;

use Byte5\LaravelHarvest\Test\TestCase;

class GetTimeEntriesDataTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->harvest = app()->make('harvest');
    }

    /** @test **/
    function all_time_entries_can_be_received()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/time_entries', $this->harvest->getRequestUrl());
        });

        $this->harvest->timeEntries->get();
    }

    /** @test **/
    function a_time_entries_can_be_received_by_id()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/time_entries/12345', $this->harvest->getRequestUrl());
        });

        $this->harvest->timeEntries->find('12345');
    }
}