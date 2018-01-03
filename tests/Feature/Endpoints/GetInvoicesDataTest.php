<?php

namespace Byte5\LaravelHarvest\Test\Feature\Endpoints;

use Byte5\LaravelHarvest\Test\TestCase;

class GetInvoicesDataTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->harvest = app()->make('harvest');
    }

    /** @test **/
    function all_invoices_can_be_received()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/invoices', $this->harvest->getRequestUrl());
        });

        $this->harvest->invoices->get();
    }

    /** @test **/
    function a_invoices_can_be_received_by_id()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/invoices/12345', $this->harvest->getRequestUrl());
        });

        $this->harvest->invoices->find('12345');
    }
}