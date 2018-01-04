<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

use Illuminate\Support\Collection;
use Byte5\LaravelHarvest\ApiResponse;
use Byte5\LaravelHarvest\Test\TestCase;
use Byte5\LaravelHarvest\Models\InvoicePayment;
use Byte5\LaravelHarvest\Test\Fakes\FakeZttpResponse;

class TransformInvoicePaymentsTest extends TestCase
{
    /** @test **/
    function it_can_transform_invoice_payments_api_responses_into_their_corresponding_models()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $collection = (new ApiResponse($apiResult, InvoicePayment::class))->toCollection();;

        $this->assertTrue($collection instanceof Collection);
        $this->assertTrue($collection->first() instanceof InvoicePayment);
    }

    /** @test **/
    function it_can_transform_invoice_payments_api_responses_into_a_paginated_collection()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $paginatedCollection = (new ApiResponse($apiResult, InvoicePayment::class))
            ->toPaginatedCollection();

        $this->assertTrue($paginatedCollection['invoice_payments'] instanceof Collection);
        $this->assertTrue(array_key_exists('total_pages', $paginatedCollection));
    }

    /**
     * @return array
     */
    private function getFakeData()
    {
        return [
            'invoice_payments' => [
                [
                    'id' => 10112854,
                    'amount' => 10700,
                    'paid_at' => '2017-02-21T00:00:00Z',
                    'recorded_by' => 'Alice Doe',
                    'recorded_by_email' => 'alice@example.com',
                    'notes' => 'Paid via check #4321',
                    'transaction_id' => NULL,
                    'created_at' => '2017-06-27T16:24:57Z',
                    'updated_at' => '2017-06-27T16:24:57Z',
                    'payment_gateway' => [
                        'id' => 1234,
                        'name' => 'Linkpoint International',
                    ],
                ],
            ],
            'per_page' => 100,
            'total_pages' => 1,
            'total_entries' => 1,
            'next_page' => NULL,
            'previous_page' => NULL,
            'page' => 1,
            'links' => [
                'first' => 'https://api.harvestapp.com/v2/invoices/13150378/payments?page=1&per_page=100',
                'next' => NULL,
                'previous' => NULL,
                'last' => 'https://api.harvestapp.com/v2/invoices/13150378/payments?page=1&per_page=100',
            ],
        ];
    }
}