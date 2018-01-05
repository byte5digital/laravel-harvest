<?php

namespace Byte5\LaravelHarvest\Test\Feature\Endpoints;

use Byte5\LaravelHarvest\Test\TestCase;

class GetExpensesDataTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->harvest = app()->make('harvest');
    }

    /** @test **/
    public function all_expenses_can_be_received()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/expenses', $this->harvest->getRequestUrl());
        });

        $this->harvest->expenses->get();
    }

    /** @test **/
    public function a_expense_can_be_received_by_id()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/expenses/12345', $this->harvest->getRequestUrl());
        });

        $this->harvest->expenses->find('12345');
    }
}
