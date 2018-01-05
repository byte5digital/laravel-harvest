<?php

namespace Byte5\LaravelHarvest\Test\Feature\Endpoints;

use Byte5\LaravelHarvest\Test\TestCase;

class GetProjectsDataTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->harvest = app()->make('harvest');
    }

    /** @test **/
    public function all_projects_can_be_received()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/projects', $this->harvest->getRequestUrl());
        });

        $this->harvest->projects->get();
    }

    /** @test **/
    public function a_projects_can_be_received_by_id()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/projects/12345', $this->harvest->getRequestUrl());
        });

        $this->harvest->projects->find('12345');
    }
}
