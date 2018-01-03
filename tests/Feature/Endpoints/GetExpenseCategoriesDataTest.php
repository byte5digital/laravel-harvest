<?php

namespace Byte5\LaravelHarvest\Test\Feature\Endpoints;

use Byte5\LaravelHarvest\Test\TestCase;

class GetExpenseCategoriesDataTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->harvest = app()->make('harvest');
    }

    /** @test **/
    function all_expense_categories_can_be_received()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/expense_categories', $this->harvest->getRequestUrl());
        });

        $this->harvest->expenseCategories->get();
    }

    /** @test **/
    function a_expense_categories_can_be_received_by_id()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/expense_categories/12345', $this->harvest->getRequestUrl());
        });

        $this->harvest->expenseCategories->find('12345');
    }
}