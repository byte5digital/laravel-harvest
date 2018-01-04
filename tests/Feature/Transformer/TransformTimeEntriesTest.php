<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

use Illuminate\Support\Collection;
use Byte5\LaravelHarvest\ApiResponse;
use Byte5\LaravelHarvest\Test\TestCase;
use Byte5\LaravelHarvest\Models\TimeEntry;
use Byte5\LaravelHarvest\Test\Fakes\FakeZttpResponse;

class TransformTimeEntriesTest extends TestCase
{
    /** @test **/
    function it_can_transform_time_entries_api_responses_into_their_corresponding_models()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $collection = (new ApiResponse($apiResult, TimeEntry::class))->toCollection();;

        $this->assertTrue($collection instanceof Collection);
        $this->assertTrue($collection->first() instanceof TimeEntry);
    }

    /** @test **/
    function it_can_transform_time_entries_api_responses_into_a_paginated_collection()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $paginatedCollection = (new ApiResponse($apiResult, TimeEntry::class))
            ->toPaginatedCollection();

        $this->assertTrue($paginatedCollection['time_entries'] instanceof Collection);
        $this->assertTrue(array_key_exists('total_pages', $paginatedCollection));
    }

    /**
     * @return array
     */
    private function getFakeData()
    {
        return [
            'time_entries' => [
                [
                    'id' => 636709355,
                    'spent_date' => '2017-03-02',
                    'user' => [
                        'id' => 1782959,
                        'name' => 'Kim Allen',
                    ],
                    'client' => [
                        'id' => 5735774,
                        'name' => 'ABC Corp',
                    ],
                    'project' => [
                        'id' => 14307913,
                        'name' => 'Marketing Website',
                    ],
                    'task' => [
                        'id' => 8083365,
                        'name' => 'Graphic Design',
                    ],
                    'user_assignment' => [
                        'id' => 125068553,
                        'is_project_manager' => true,
                        'is_active' => true,
                        'budget' => NULL,
                        'created_at' => '2017-06-26T22:32:52Z',
                        'updated_at' => '2017-06-26T22:32:52Z',
                        'hourly_rate' => 100,
                    ],
                    'task_assignment' => [
                        'id' => 155502709,
                        'billable' => true,
                        'is_active' => true,
                        'created_at' => '2017-06-26T21:36:23Z',
                        'updated_at' => '2017-06-26T21:36:23Z',
                        'hourly_rate' => 100,
                        'budget' => NULL,
                    ],
                    'hours' => 2,
                    'notes' => 'Adding CSS styling',
                    'created_at' => '2017-06-27T15:50:15Z',
                    'updated_at' => '2017-06-27T16:47:14Z',
                    'is_locked' => true,
                    'locked_reason' => 'Item Approved and Locked for this Time Period',
                    'is_closed' => true,
                    'is_billed' => false,
                    'timer_started_at' => NULL,
                    'started_time' => '3:00pm',
                    'ended_time' => '5:00pm',
                    'is_running' => false,
                    'invoice' => NULL,
                    'external_reference' => NULL,
                    'billable' => true,
                    'budgeted' => true,
                    'billable_rate' => 100,
                    'cost_rate' => 50,
                ],
                [
                    'id' => 636708723,
                    'spent_date' => '2017-03-01',
                    'user' => [
                        'id' => 1782959,
                        'name' => 'Kim Allen',
                    ],
                    'client' => [
                        'id' => 5735776,
                        'name' => '123 Industries',
                    ],
                    'project' => [
                        'id' => 14308069,
                        'name' => 'Online Store - Phase 1',
                    ],
                    'task' => [
                        'id' => 8083366,
                        'name' => 'Programming',
                    ],
                    'user_assignment' => [
                        'id' => 125068554,
                        'is_project_manager' => true,
                        'is_active' => true,
                        'budget' => NULL,
                        'created_at' => '2017-06-26T22:32:52Z',
                        'updated_at' => '2017-06-26T22:32:52Z',
                        'hourly_rate' => 100,
                    ],
                    'task_assignment' => [
                        'id' => 155505014,
                        'billable' => true,
                        'is_active' => true,
                        'created_at' => '2017-06-26T21:52:18Z',
                        'updated_at' => '2017-06-26T21:52:18Z',
                        'hourly_rate' => 100,
                        'budget' => NULL,
                    ],
                    'hours' => 1,
                    'notes' => 'Importing products',
                    'created_at' => '2017-06-27T15:49:28Z',
                    'updated_at' => '2017-06-27T16:47:14Z',
                    'is_locked' => true,
                    'locked_reason' => 'Item Invoiced and Approved and Locked for this Time Period',
                    'is_closed' => true,
                    'is_billed' => true,
                    'timer_started_at' => NULL,
                    'started_time' => '1:00pm',
                    'ended_time' => '2:00pm',
                    'is_running' => false,
                    'invoice' => [
                        'id' => 13150403,
                        'number' => '1001',
                    ],
                    'external_reference' => NULL,
                    'billable' => true,
                    'budgeted' => true,
                    'billable_rate' => 100,
                    'cost_rate' => 50,
                ],
            ],
            'per_page' => 100,
            'total_pages' => 1,
            'total_entries' => 4,
            'next_page' => NULL,
            'previous_page' => NULL,
            'page' => 1,
            'links' => [
                'first' => 'https://api.harvestapp.com/v2/time_entries?page=1&per_page=100',
                'next' => NULL,
                'previous' => NULL,
                'last' => 'https://api.harvestapp.com/v2/time_entries?page=1&per_page=100',
            ],
        ];
    }
}