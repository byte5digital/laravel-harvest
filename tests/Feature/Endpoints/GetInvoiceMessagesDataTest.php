<?php

namespace Byte5\LaravelHarvest\Test\Feature\Endpoints;

use Byte5\LaravelHarvest\Test\TestCase;

class GetInvoiceMessagesDataTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->harvest = app()->make('harvest');
    }

    /** @test **/
    public function all_invoice_messages_associated_with_an_invoice_can_be_received()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/invoices/12345/messages', $this->harvest->getRequestUrl());
        });

        $this->harvest->invoiceMessages->fromInvoice('12345')->get();
    }
}
