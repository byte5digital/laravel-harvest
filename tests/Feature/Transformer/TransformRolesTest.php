<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

use Illuminate\Support\Collection;
use Byte5\LaravelHarvest\ApiResponse;
use Byte5\LaravelHarvest\Models\Role;
use Byte5\LaravelHarvest\Test\TestCase;
use Byte5\LaravelHarvest\Test\Fakes\FakeZttpResponse;

class TransformRolesTest extends TestCase
{
    /** @test **/
    public function it_can_transform_roles_api_responses_into_their_corresponding_models()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $collection = (new ApiResponse($apiResult, Role::class))->toCollection();

        $this->assertTrue($collection instanceof Collection);
        $this->assertTrue($collection->first() instanceof Role);
    }

    /** @test **/
    public function it_can_transform_roles_api_responses_into_a_paginated_collection()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $paginatedCollection = (new ApiResponse($apiResult, Role::class))
            ->toPaginatedCollection();

        $this->assertTrue($paginatedCollection['roles'] instanceof Collection);
        $this->assertTrue(array_key_exists('total_pages', $paginatedCollection));
    }

    /**
     * @return array
     */
    private function getFakeData()
    {
        return [
            'roles' => [
                [
                    'id' => 1782974,
                    'name' => 'Founder',
                    'user_ids' => [
                        0 => 8083365,
                    ],
                    'created_at' => '2017-06-26T22:34:41Z',
                    'updated_at' => '2017-06-26T22:34:52Z',
                ],
                [
                    'id' => 1782959,
                    'name' => 'Developer',
                    'user_ids' => [
                        0 => 8083366,
                    ],
                    'created_at' => '2017-06-26T22:15:45Z',
                    'updated_at' => '2017-06-26T22:32:52Z',
                ],
                [
                    'id' => 1782884,
                    'name' => 'Designer',
                    'user_ids' => [
                        0 => 8083367,
                    ],
                    'created_at' => '2017-06-26T20:41:00Z',
                    'updated_at' => '2017-06-26T20:42:25Z',
                ],
            ],
            'per_page' => 100,
            'total_pages' => 1,
            'total_entries' => 3,
            'next_page' => null,
            'previous_page' => null,
            'page' => 1,
            'links' => [
                'first' => 'https://api.harvestapp.com/v2/roles?page=1&per_page=100',
                'next' => null,
                'previous' => null,
                'last' => 'https://api.harvestapp.com/v2/roles?page=1&per_page=100',
            ],
        ];
    }
}
