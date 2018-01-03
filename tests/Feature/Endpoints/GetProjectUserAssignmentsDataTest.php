<?php

namespace Byte5\LaravelHarvest\Test\Feature\Endpoints;

use Byte5\LaravelHarvest\Test\TestCase;

class GetProjectUserAssignmentsDataTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->harvest = app()->make('harvest');
    }

    /** @test **/
    function all_project_user_assignments_associated_with_a_project_can_be_received()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/projects/12345/user_assignments', $this->harvest->getRequestUrl());
        });

        $this->harvest->userAssignments->fromProject('12345')->get();
    }

    /** @test **/
    function a_project_user_assignments_can_be_received_by_id()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/projects/12345/user_assignments/67890', $this->harvest->getRequestUrl());
        });

        $this->harvest->userAssignments->fromProject('12345')->find('67890');
    }
}