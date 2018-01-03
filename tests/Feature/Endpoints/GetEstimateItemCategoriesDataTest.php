<?php

namespace Byte5\LaravelHarvest\Test\Feature\Endpoints;

use Byte5\LaravelHarvest\Test\TestCase;

class GetEstimateItemCategoriesDataTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->harvest = app()->make('harvest');
    }

    /** @test **/
    function all_estimate_item_categories_can_be_received()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/estimate_item_categories', $this->harvest->getRequestUrl());
        });

        $this->harvest->estimateItemCategory->get();
    }

    /** @test **/
    function a_estimate_item_categories_can_be_received_by_id()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/estimate_item_categories/12345', $this->harvest->getRequestUrl());
        });

        $this->harvest->estimateItemCategory->find('12345');
    }
}