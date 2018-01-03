<?php

namespace Byte5\LaravelHarvest\Test\Feature\Endpoints;

use Byte5\LaravelHarvest\Test\TestCase;

class GetInvoiceItemCategoriesDataTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->harvest = app()->make('harvest');
    }

    /** @test **/
    function all_invoice_item_categories_can_be_received()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/invoice_item_categories', $this->harvest->getRequestUrl());
        });

        $this->harvest->invoiceItemCategories->get();
    }

    /** @test **/
    function a_invoice_item_categories_can_be_received_by_id()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/invoice_item_categories/12345', $this->harvest->getRequestUrl());
        });

        $this->harvest->invoiceItemCategories->find('12345');
    }
}