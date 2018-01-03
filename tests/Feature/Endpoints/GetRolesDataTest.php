<?php

namespace Byte5\LaravelHarvest\Test\Feature\Endpoints;

use Byte5\LaravelHarvest\Test\TestCase;

class GetRolesDataTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->harvest = app()->make('harvest');
    }

    /** @test **/
    function all_roles_can_be_received()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/roles', $this->harvest->getRequestUrl());
        });

        $this->harvest->roles->get();
    }

    /** @test **/
    function a_roles_can_be_received_by_id()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/roles/12345', $this->harvest->getRequestUrl());
        });

        $this->harvest->roles->find('12345');
    }
}