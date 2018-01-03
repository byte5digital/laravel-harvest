<?php

namespace Byte5\LaravelHarvest\Test\Feature\Endpoints;

use Byte5\LaravelHarvest\Test\TestCase;

class GetInvoicePaymentsDataTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->harvest = app()->make('harvest');
    }

    /** @test **/
    function all_invoice_payments_associated_with_an_invoice_can_be_received()
    {
        $this->harvest->beforeCraftingResponse(function () {
            $this->assertEquals('https://api.harvestapp.com/v2/invoices/12345/payments', $this->harvest->getRequestUrl());
        });

        $this->harvest->invoicePayments->fromInvoice('12345')->get();
    }
}