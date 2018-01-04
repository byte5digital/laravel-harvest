<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

use Illuminate\Support\Collection;
use Byte5\LaravelHarvest\ApiResponse;
use Byte5\LaravelHarvest\Test\TestCase;
use Byte5\LaravelHarvest\Models\TaskAssignment;
use Byte5\LaravelHarvest\Test\Fakes\FakeZttpResponse;

class TransformTaskAssignmentsTest extends TestCase
{
    /** @test **/
    function it_can_transform_task_assignments_api_responses_into_their_corresponding_models()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $collection = (new ApiResponse($apiResult, TaskAssignment::class))->toCollection();;

        $this->assertTrue($collection instanceof Collection);
        $this->assertTrue($collection->first() instanceof TaskAssignment);
    }

    /** @test **/
    function it_can_transform_task_assignments_api_responses_into_a_paginated_collection()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $paginatedCollection = (new ApiResponse($apiResult, TaskAssignment::class))
            ->toPaginatedCollection();

        $this->assertTrue($paginatedCollection['task_assignments'] instanceof Collection);
        $this->assertTrue(array_key_exists('total_pages', $paginatedCollection));
    }

    /**
     * @return array
     */
    private function getFakeData()
    {
        return [
            'task_assignments' => [
                [
                    'id' => 155505016,
                    'billable' => false,
                    'is_active' => true,
                    'created_at' => '2017-06-26T21:52:18Z',
                    'updated_at' => '2017-06-26T21:54:06Z',
                    'task' => [
                        'id' => 8083369,
                        'name' => 'Research',
                    ],
                    'hourly_rate' => 100,
                    'budget' => NULL,
                ],
                [
                    'id' => 155505015,
                    'billable' => true,
                    'is_active' => true,
                    'created_at' => '2017-06-26T21:52:18Z',
                    'updated_at' => '2017-06-26T21:52:18Z',
                    'task' => [
                        'id' => 8083368,
                        'name' => 'Project Management',
                    ],
                    'hourly_rate' => 100,
                    'budget' => NULL,
                ],
                [
                    'id' => 155505014,
                    'billable' => true,
                    'is_active' => true,
                    'created_at' => '2017-06-26T21:52:18Z',
                    'updated_at' => '2017-06-26T21:52:18Z',
                    'task' => [
                        'id' => 8083366,
                        'name' => 'Programming',
                    ],
                    'hourly_rate' => 100,
                    'budget' => NULL,
                ],
                [
                    'id' => 155505013,
                    'billable' => true,
                    'is_active' => true,
                    'created_at' => '2017-06-26T21:52:18Z',
                    'updated_at' => '2017-06-26T21:52:18Z',
                    'task' => [
                        'id' => 8083365,
                        'name' => 'Graphic Design',
                    ],
                    'hourly_rate' => 100,
                    'budget' => NULL,
                ],
            ],
            'per_page' => 100,
            'total_pages' => 1,
            'total_entries' => 4,
            'next_page' => NULL,
            'previous_page' => NULL,
            'page' => 1,
            'links' => [
                'first' => 'https://api.harvestapp.com/v2/projects/14308069/task_assignments?page=1&per_page=100',
                'next' => NULL,
                'previous' => NULL,
                'last' => 'https://api.harvestapp.com/v2/projects/14308069/task_assignments?page=1&per_page=100',
            ],
        ];
    }
}