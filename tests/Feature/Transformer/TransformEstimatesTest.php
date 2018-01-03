<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

use Illuminate\Support\Collection;
use Byte5\LaravelHarvest\ApiResponse;
use Byte5\LaravelHarvest\Test\TestCase;
use Byte5\LaravelHarvest\Models\Estimate;
use Byte5\LaravelHarvest\Test\Fakes\FakeZttpResponse;

class TransformEstimatesTest extends TestCase
{
    use MigrationSetup;

    /** @test **/
    function it_can_transform_estimates_api_responses_into_their_corresponding_models()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $collection = (new ApiResponse($apiResult, Estimate::class))->toCollection();

        $this->assertTrue($collection instanceof Collection);
        $this->assertTrue($collection->first() instanceof Estimate);
    }

    /** @test **/
    function it_can_transform_estimates_api_responses_into_a_paginated_collection()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $paginatedCollection = (new ApiResponse($apiResult, Estimate::class))
            ->toPaginatedCollection();

        $this->assertTrue($paginatedCollection['estimates'] instanceof Collection);
        $this->assertTrue(array_key_exists('total_pages', $paginatedCollection));
    }

    /**
     * @return array
     */
    private function getFakeData()
    {
        return [
            'estimates' => [
                [
                    'id' => 1439818,
                    'client_key' => '13dc088aa7d51ec687f186b146730c3c75dc7423',
                    'number' => '1001',
                    'purchase_order' => '5678',
                    'amount' => 9630,
                    'tax' => 5,
                    'tax_amount' => 450,
                    'tax2' => 2,
                    'tax2_amount' => 180,
                    'discount' => 10,
                    'discount_amount' => 1000,
                    'subject' => 'Online Store - Phase 2',
                    'notes' => 'Some notes about the estimate',
                    'issue_date' => '2017-06-01',
                    'sent_at' => '2017-06-27T16:11:33Z',
                    'created_at' => '2017-06-27T16:11:24Z',
                    'updated_at' => '2017-06-27T16:13:56Z',
                    'accepted_at' => NULL,
                    'declined_at' => NULL,
                    'currency' => 'USD',
                    'client' => [
                        'id' => 5735776,
                        'name' => '123 Industries',
                    ],
                    'creator' => [
                        'id' => 1782884,
                        'name' => 'Bob Powell',
                    ],
                    'line_items' => [
                        [
                            'id' => 53334195,
                            'kind' => 'Service',
                            'description' => 'Phase 2 of the Online Store',
                            'quantity' => 100,
                            'unit_price' => 100,
                            'amount' => 10000,
                            'taxed' => true,
                            'taxed2' => true,
                        ]
                    ]
                ],
                [
                    'id' => 1439814,
                    'client_key' => 'a5ffaeb30c55776270fcd3992b70332d769f97e7',
                    'number' => '1000',
                    'purchase_order' => '1234',
                    'amount' => 21000,
                    'tax' => 5,
                    'tax_amount' => 1000,
                    'tax2' => NULL,
                    'tax2_amount' => 0,
                    'discount' => NULL,
                    'discount_amount' => 0,
                    'subject' => 'Online Store - Phase 1',
                    'notes' => 'Some notes about the estimate',
                    'issue_date' => '2017-01-01',
                    'sent_at' => '2017-06-27T16:10:30Z',
                    'created_at' => '2017-06-27T16:09:33Z',
                    'updated_at' => '2017-06-27T16:12:00Z',
                    'accepted_at' => '2017-06-27T16:10:32Z',
                    'declined_at' => NULL,
                    'currency' => 'USD',
                    'client' => [
                        'id' => 5735776,
                        'name' => '123 Industries',
                    ],
                    'creator' => [
                        'id' => 1782884,
                        'name' => 'Bob Powell',
                    ],
                    'line_items' => [
                        [
                            'id' => 57531966,
                            'kind' => 'Service',
                            'description' => 'Phase 1 of the Online Store',
                            'quantity' => 1,
                            'unit_price' => 20000,
                            'amount' => 20000,
                            'taxed' => true,
                            'taxed2' => false,
                        ]
                    ]
                ]
            ],
            'per_page' => 100,
            'total_pages' => 1,
            'total_entries' => 2,
            'next_page' => NULL,
            'previous_page' => NULL,
            'page' => 1,
            'links' => [
                'first' => 'https://api.harvestapp.com/v2/estimates?page=1&per_page=100',
                'next' => NULL,
                'previous' => NULL,
                'last' => 'https://api.harvestapp.com/v2/estimates?page=1&per_page=100',
            ],
        ];
    }
}