<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Byte5\LaravelHarvest\ApiResponse;
use Byte5\LaravelHarvest\Models\Client;
use Byte5\LaravelHarvest\Test\TestCase;
use Byte5\LaravelHarvest\Test\Fakes\FakeZttpResponse;

class TransformClientsTest extends TestCase
{
    /** @test **/
    public function it_can_transform_clients_api_responses_into_their_corresponding_models()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $collection = (new ApiResponse($apiResult, Client::class))->toCollection();

        $this->assertTrue($collection instanceof Collection);
        $this->assertTrue($collection->first() instanceof Client);
    }

    /** @test **/
    public function it_can_transform_clients_api_responses_into_a_paginated_collection()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $paginatedCollection = (new ApiResponse($apiResult, Client::class))
            ->toPaginatedCollection();

        $this->assertTrue($paginatedCollection['clients'] instanceof Collection);
        $this->assertTrue(array_key_exists('total_pages', $paginatedCollection));
    }

    /**
     * @return array
     */
    private function getFakeData()
    {
        return [
            'clients' => [
                [
                    'id' => 1234567,
                    'name' => 'Example GmbH & Co. KG',
                    'is_active' => true,
                    'address' => '<p>Some Address Stuff</p>',
                    'created_at' => Carbon::parse('-1 week'),
                    'updated_at' => Carbon::parse('-1 week'),
                    'currency' => 'EUR',
                ],
            ],
            'per_page' => 1,
            'total_pages' => 1,
            'total_entries' => 1,
            'next_page' => null,
            'previous_page' => null,
            'page' => 1,
            'links' => [
                'first' => 'https://api.harvestapp.com/v2/clients?page=1&per_page=100',
                'next' => null,
                'previous' => null,
                'last' => 'https://api.harvestapp.com/v2/clients?page=1&per_page=100',
            ],
        ];
    }
}
