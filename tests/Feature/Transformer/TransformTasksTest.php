<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

use Illuminate\Support\Collection;
use Byte5\LaravelHarvest\ApiResponse;
use Byte5\LaravelHarvest\Models\Task;
use Byte5\LaravelHarvest\Test\TestCase;
use Byte5\LaravelHarvest\Test\Fakes\FakeZttpResponse;

class TransformTasksTest extends TestCase
{
    use MigrationSetup;

    /** @test **/
    function it_can_transform_tasks_api_responses_into_their_corresponding_models()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $collection = (new ApiResponse($apiResult, Task::class))->toCollection();;

        $this->assertTrue($collection instanceof Collection);
        $this->assertTrue($collection->first() instanceof Task);
    }

    /** @test **/
    function it_can_transform_tasks_api_responses_into_a_paginated_collection()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $paginatedCollection = (new ApiResponse($apiResult, Task::class))
            ->toPaginatedCollection();

        $this->assertTrue($paginatedCollection['tasks'] instanceof Collection);
        $this->assertTrue(array_key_exists('total_pages', $paginatedCollection));
    }

    /**
     * @return array
     */
    private function getFakeData()
    {
        return [
            'tasks' => [
                [
                    'id' => 8083800,
                    'name' => 'Business Development',
                    'billable_by_default' => false,
                    'default_hourly_rate' => 0,
                    'is_default' => false,
                    'is_active' => true,
                    'created_at' => '2017-06-26T22:08:25Z',
                    'updated_at' => '2017-06-26T22:08:25Z',
                ],
                [
                    'id' => 8083369,
                    'name' => 'Research',
                    'billable_by_default' => false,
                    'default_hourly_rate' => 0,
                    'is_default' => true,
                    'is_active' => true,
                    'created_at' => '2017-06-26T20:41:00Z',
                    'updated_at' => '2017-06-26T21:53:34Z',
                ],
                [
                    'id' => 8083368,
                    'name' => 'Project Management',
                    'billable_by_default' => true,
                    'default_hourly_rate' => 100,
                    'is_default' => true,
                    'is_active' => true,
                    'created_at' => '2017-06-26T20:41:00Z',
                    'updated_at' => '2017-06-26T21:14:10Z',
                ],
                [
                    'id' => 8083366,
                    'name' => 'Programming',
                    'billable_by_default' => true,
                    'default_hourly_rate' => 100,
                    'is_default' => true,
                    'is_active' => true,
                    'created_at' => '2017-06-26T20:41:00Z',
                    'updated_at' => '2017-06-26T21:14:07Z',
                ],
                [
                    'id' => 8083365,
                    'name' => 'Graphic Design',
                    'billable_by_default' => true,
                    'default_hourly_rate' => 100,
                    'is_default' => true,
                    'is_active' => true,
                    'created_at' => '2017-06-26T20:41:00Z',
                    'updated_at' => '2017-06-26T21:14:02Z',
                ],
            ],
            'per_page' => 100,
            'total_pages' => 1,
            'total_entries' => 5,
            'next_page' => NULL,
            'previous_page' => NULL,
            'page' => 1,
            'links' => [
                'first' => 'https://api.harvestapp.com/v2/tasks?page=1&per_page=100',
                'next' => NULL,
                'previous' => NULL,
                'last' => 'https://api.harvestapp.com/v2/tasks?page=1&per_page=100',
            ],
        ];
    }
}