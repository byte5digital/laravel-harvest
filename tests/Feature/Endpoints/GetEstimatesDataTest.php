<?php

namespace Byte5\LaravelHarvest\Test\Feature\Endpoints;

use Byte5\LaravelHarvest\Test\TestCase;

class GetEstimatesDataTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->harvest = app()->make('harvest');
    }

    /** @test **/
    public function all_estimates_can_be_received()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/estimates', $this->harvest->getRequestUrl());
        });

        $this->harvest->estimates->get();
    }

    /** @test **/
    public function a_estimate_can_be_received_by_id()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/estimates/12345', $this->harvest->getRequestUrl());
        });

        $this->harvest->estimates->find('12345');
    }
}
