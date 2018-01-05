<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

use Illuminate\Support\Collection;
use Byte5\LaravelHarvest\ApiResponse;
use Byte5\LaravelHarvest\Test\TestCase;
use Byte5\LaravelHarvest\Models\UserAssignment;
use Byte5\LaravelHarvest\Test\Fakes\FakeZttpResponse;

class TransformUserAssignmentsTest extends TestCase
{
    /** @test **/
    public function it_can_transform_user_assignments_api_responses_into_their_corresponding_models()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $collection = (new ApiResponse($apiResult, UserAssignment::class))->toCollection();

        $this->assertTrue($collection instanceof Collection);
        $this->assertTrue($collection->first() instanceof UserAssignment);
    }

    /** @test **/
    public function it_can_transform_user_assignments_api_responses_into_a_paginated_collection()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $paginatedCollection = (new ApiResponse($apiResult, UserAssignment::class))
            ->toPaginatedCollection();

        $this->assertTrue($paginatedCollection['user_assignments'] instanceof Collection);
        $this->assertTrue(array_key_exists('total_pages', $paginatedCollection));
    }

    /**
     * @return array
     */
    private function getFakeData()
    {
        return [
            'user_assignments' => [
                [
                    'id' => 125068554,
                    'is_project_manager' => true,
                    'is_active' => true,
                    'budget' => null,
                    'created_at' => '2017-06-26T22:32:52Z',
                    'updated_at' => '2017-06-26T22:32:52Z',
                    'hourly_rate' => 100,
                    'user' => [
                        'id' => 1782959,
                        'name' => 'Kim Allen',
                    ],
                ],
                [
                    'id' => 125066109,
                    'is_project_manager' => true,
                    'is_active' => true,
                    'budget' => null,
                    'created_at' => '2017-06-26T21:52:18Z',
                    'updated_at' => '2017-06-26T21:52:18Z',
                    'hourly_rate' => 100,
                    'user' => [
                        'id' => 1782884,
                        'name' => 'Bob Powell',
                    ],
                ],
            ],
            'per_page' => 100,
            'total_pages' => 1,
            'total_entries' => 2,
            'next_page' => null,
            'previous_page' => null,
            'page' => 1,
            'links' => [
                'first' => 'https://api.harvestapp.com/v2/projects/14308069/user_assignments?page=1&per_page=100',
                'next' => null,
                'previous' => null,
                'last' => 'https://api.harvestapp.com/v2/projects/14308069/user_assignments?page=1&per_page=100',
            ],
        ];
    }
}
