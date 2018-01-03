<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

use Illuminate\Support\Collection;
use Byte5\LaravelHarvest\ApiResponse;
use Byte5\LaravelHarvest\Test\TestCase;
use Byte5\LaravelHarvest\Models\Invoice;
use Byte5\LaravelHarvest\Test\Fakes\FakeZttpResponse;

class TransformInvoicesTest extends TestCase
{
    use MigrationSetup;

    /** @test **/
    function it_can_transform_invoices_api_responses_into_their_corresponding_models()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $collection = (new ApiResponse($apiResult, Invoice::class))->toCollection();;

        $this->assertTrue($collection instanceof Collection);
        $this->assertTrue($collection->first() instanceof Invoice);
    }

    /** @test **/
    function it_can_transform_invoices_api_responses_into_a_paginated_collection()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $paginatedCollection = (new ApiResponse($apiResult, Invoice::class))
            ->toPaginatedCollection();

        $this->assertTrue($paginatedCollection['invoices'] instanceof Collection);
        $this->assertTrue(array_key_exists('total_pages', $paginatedCollection));
    }

    /**
     * @return array
     */
    private function getFakeData()
    {
        return [
            'invoices' => [
                [
                    'id' => 13150403,
                    'client_key' => '21312da13d457947a217da6775477afee8c2eba8',
                    'number' => '1001',
                    'purchase_order' => '',
                    'amount' => 288.8999999999999772626324556767940521240234375,
                    'due_amount' => 288.8999999999999772626324556767940521240234375,
                    'tax' => 5,
                    'tax_amount' => 13.5,
                    'tax2' => 2,
                    'tax2_amount' => 5.4000000000000003552713678800500929355621337890625,
                    'discount' => 10,
                    'discount_amount' => 30,
                    'subject' => 'Online Store - Phase 1',
                    'notes' => 'Some notes about the invoice.',
                    'period_start' => '2017-03-01',
                    'period_end' => '2017-03-01',
                    'issue_date' => '2017-04-01',
                    'due_date' => '2017-04-01',
                    'sent_at' => '2017-08-23T22:25:59Z',
                    'paid_at' => NULL,
                    'closed_at' => NULL,
                    'created_at' => '2017-06-27T16:27:16Z',
                    'updated_at' => '2017-08-23T22:25:59Z',
                    'currency' => 'EUR',
                    'client' => [
                        'id' => 5735776,
                        'name' => '123 Industries',
                    ],
                    'estimate' => NULL,
                    'retainer' => NULL,
                    'creator' => [
                        'id' => 1782884,
                        'name' => 'Bob Powell',
                    ],
                    'line_items' => [
                        [
                            'id' => 53341602,
                            'kind' => 'Service',
                            'description' => '03/01/2017 - Project Management: [9:00am - 11:00am] Planning meetings',
                            'quantity' => 2,
                            'unit_price' => 100,
                            'amount' => 200,
                            'taxed' => true,
                            'taxed2' => true,
                            'project' => [
                                'id' => 14308069,
                                'name' => 'Online Store - Phase 1',
                                'code' => 'OS1',
                            ],
                        ],
                        [
                            'id' => 53341603,
                            'kind' => 'Service',
                            'description' => '03/01/2017 - Programming: [1:00pm - 2:00pm] Importing products',
                            'quantity' => 1,
                            'unit_price' => 100,
                            'amount' => 100,
                            'taxed' => true,
                            'taxed2' => true,
                            'project' => [
                                'id' => 14308069,
                                'name' => 'Online Store - Phase 1',
                                'code' => 'OS1',
                            ],
                        ],
                    ],
                ],
                [
                    'id' => 13150378,
                    'client_key' => '9e97f4a65c5b83b1fc02f54e5a41c9dc7d458542',
                    'number' => '1000',
                    'purchase_order' => '1234',
                    'amount' => 10700,
                    'due_amount' => 0,
                    'tax' => 5,
                    'tax_amount' => 500,
                    'tax2' => 2,
                    'tax2_amount' => 200,
                    'discount' => NULL,
                    'discount_amount' => 0,
                    'subject' => 'Online Store - Phase 1',
                    'notes' => 'Some notes about the invoice.',
                    'period_start' => NULL,
                    'period_end' => NULL,
                    'issue_date' => '2017-02-01',
                    'due_date' => '2017-03-03',
                    'sent_at' => '2017-02-01T07:00:00Z',
                    'paid_at' => '2017-02-21T00:00:00Z',
                    'closed_at' => NULL,
                    'created_at' => '2017-06-27T16:24:30Z',
                    'updated_at' => '2017-06-27T16:24:57Z',
                    'currency' => 'USD',
                    'client' => [
                        'id' => 5735776,
                        'name' => '123 Industries',
                    ],
                    'estimate' => [
                        'id' => 1439814,
                    ],
                    'retainer' => NULL,
                    'creator' => [
                        'id' => 1782884,
                        'name' => 'Bob Powell',
                    ],
                    'line_items' => [
                        [
                            'id' => 53341450,
                            'kind' => 'Service',
                            'description' => '50% of Phase 1 of the Online Store',
                            'quantity' => 100,
                            'unit_price' => 100,
                            'amount' => 10000,
                            'taxed' => true,
                            'taxed2' => true,
                            'project' => [
                                'id' => 14308069,
                                'name' => 'Online Store - Phase 1',
                                'code' => 'OS1',
                            ],
                        ],
                    ],
                ],
            ],
            'per_page' => 100,
            'total_pages' => 1,
            'total_entries' => 2,
            'next_page' => NULL,
            'previous_page' => NULL,
            'page' => 1,
            'links' => [
                'first' => 'https://api.harvestapp.com/v2/invoices?page=1&per_page=100',
                'next' => NULL,
                'previous' => NULL,
                'last' => 'https://api.harvestapp.com/v2/invoices?page=1&per_page=100',
            ]
        ];
    }
}