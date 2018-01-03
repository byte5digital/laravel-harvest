<?php

namespace Byte5\LaravelHarvest\Test\Feature\Endpoints;

use Byte5\LaravelHarvest\Test\TestCase;

class GetTasksDataTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->harvest = app()->make('harvest');
    }

    /** @test **/
    function all_tasks_can_be_received()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/tasks', $this->harvest->getRequestUrl());
        });

        $this->harvest->tasks->get();
    }

    /** @test **/
    function a_tasks_can_be_received_by_id()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/tasks/12345', $this->harvest->getRequestUrl());
        });

        $this->harvest->tasks->find('12345');
    }
}