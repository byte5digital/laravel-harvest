<?php

namespace Byte5\LaravelHarvest\Test\Feature\Endpoints;

use Byte5\LaravelHarvest\Test\TestCase;

class GetEstimateMessagesDataTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->harvest = app()->make('harvest');
    }

    /** @test **/
    public function all_estimate_messages_associated_with_an_estimate_can_be_received()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/estimates/12345/messages', $this->harvest->getRequestUrl());
        });

        $this->harvest->estimateMessages->fromEstimate('12345')->get();
    }
}
