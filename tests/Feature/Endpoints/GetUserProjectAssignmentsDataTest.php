<?php

namespace Byte5\LaravelHarvest\Test\Feature\Endpoints;

use Byte5\LaravelHarvest\Test\TestCase;

class GetUserProjectAssignmentsDataTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->harvest = app()->make('harvest');
    }

    /** @test **/
    function all_user_project_assignments_associated_with_an_user_can_be_received()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/users/12345/project_assignments', $this->harvest->getRequestUrl());
        });

        $this->harvest->projectAssignments->getFromUser('12345');
    }
}