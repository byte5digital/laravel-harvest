<?php

namespace Byte5\LaravelHarvest\Test\Feature\Endpoints;

use Byte5\LaravelHarvest\Test\TestCase;

class GetProjectTaskAssignmentsDataTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->harvest = app()->make('harvest');
    }

    /** @test **/
    public function all_project_task_assignments_can_be_received()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/projects/12345/task_assignments', $this->harvest->getRequestUrl());
        });

        $this->harvest->taskAssignments->fromProject('12345')->get();
    }

    /** @test **/
    public function a_project_task_assignments_can_be_received_by_id()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/projects/12345/task_assignments/67890', $this->harvest->getRequestUrl());
        });

        $this->harvest->taskAssignments->fromProject('12345')->find('67890');
    }
}
