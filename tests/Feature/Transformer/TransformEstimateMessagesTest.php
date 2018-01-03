<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

use Illuminate\Support\Collection;
use Byte5\LaravelHarvest\ApiResponse;
use Byte5\LaravelHarvest\Test\TestCase;
use Byte5\LaravelHarvest\Models\EstimateMessage;
use Byte5\LaravelHarvest\Test\Fakes\FakeZttpResponse;

class TransformEstimateMessagesTest extends TestCase
{
    use MigrationSetup;

    /** @test **/
    function it_can_transform_estimate_messages_api_responses_into_their_corresponding_models()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $collection = (new ApiResponse($apiResult, EstimateMessage::class))->toCollection();

        $this->assertTrue($collection instanceof Collection);
        $this->assertTrue($collection->first() instanceof EstimateMessage);
    }

    /** @test **/
    function it_can_transform_estimate_messages_api_responses_into_a_paginated_collection()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $paginatedCollection = (new ApiResponse($apiResult, EstimateMessage::class))
            ->toPaginatedCollection();

        $this->assertTrue($paginatedCollection['estimate_messages'] instanceof Collection);
        $this->assertTrue(array_key_exists('total_pages', $paginatedCollection));
    }

    /**
     * @return array
     */
    private function getFakeData()
    {
        return [
            'estimate_messages' => [
                [
                    'id' => 2666236,
                    'sent_by' => 'Bob Powell',
                    'sent_by_email' => 'bobpowell@example.com',
                    'sent_from' => 'Bob Powell',
                    'sent_from_email' => 'bobpowell@example.com',
                    'send_me_a_copy' => true,
                    'created_at' => '2017-08-25T21:23:40Z',
                    'updated_at' => '2017-08-25T21:23:40Z',
                    'recipients' => [
                        [
                            'name' => 'Richard Roe',
                            'email' => 'richardroe@example.com',
                        ],
                        [
                            'name' => 'Bob Powell',
                            'email' => 'bobpowell@example.com',
                        ],
                    ],
                    'event_type' => NULL,
                    'subject' => 'Estimate #1001 from API Examples',
                    'body' => '---------------------------------------------
                                Estimate Summary
                                ---------------------------------------------
                                Estimate ID: 1001
                                Estimate Date: 06/01/2017
                                Client: 123 Industries
                                P.O. Number: 5678
                                Amount: $9,630.00
                                
                                You can view the estimate here:
                                
                                %estimate_url%
                                
                                Thank you!
                                ---------------------------------------------',
                ],
            ],
            'per_page' => 100,
            'total_pages' => 1,
            'total_entries' => 1,
            'next_page' => NULL,
            'previous_page' => NULL,
            'page' => 1,
            'links' => [
                'first' => 'https://api.harvestapp.com/v2/estimates/1439818/messages?page=1&per_page=100',
                'next' => NULL,
                'previous' => NULL,
                'last' => 'https://api.harvestapp.com/v2/estimates/1439818/messages?page=1&per_page=100',
            ],
        ];
    }
}