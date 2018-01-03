<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

use Illuminate\Support\Collection;
use Byte5\LaravelHarvest\ApiResponse;
use Byte5\LaravelHarvest\Test\TestCase;
use Byte5\LaravelHarvest\Models\Project;
use Byte5\LaravelHarvest\Test\Fakes\FakeZttpResponse;

class TransformProjectsTest extends TestCase
{
    use MigrationSetup;

    /** @test **/
    function it_can_transform_projects_api_responses_into_their_corresponding_models()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $collection = (new ApiResponse($apiResult, Project::class))->toCollection();;

        $this->assertTrue($collection instanceof Collection);
        $this->assertTrue($collection->first() instanceof Project);
    }

    /** @test **/
    function it_can_transform_projects_api_responses_into_a_paginated_collection()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $paginatedCollection = (new ApiResponse($apiResult, Project::class))
            ->toPaginatedCollection();

        $this->assertTrue($paginatedCollection['projects'] instanceof Collection);
        $this->assertTrue(array_key_exists('total_pages', $paginatedCollection));
    }

    /**
     * @return array
     */
    private function getFakeData()
    {
        return [
            'projects' => [
                [
                    'id' => 14308069,
                    'name' => 'Online Store - Phase 1',
                    'code' => 'OS1',
                    'is_active' => true,
                    'bill_by' => 'Project',
                    'budget' => 200,
                    'budget_by' => 'project',
                    'notify_when_over_budget' => true,
                    'over_budget_notification_percentage' => 80,
                    'over_budget_notification_date' => NULL,
                    'show_budget_to_all' => false,
                    'created_at' => '2017-06-26T21:52:18Z',
                    'updated_at' => '2017-06-26T21:54:06Z',
                    'starts_on' => '2017-06-01',
                    'ends_on' => NULL,
                    'is_billable' => true,
                    'is_fixed_fee' => false,
                    'notes' => '',
                    'client' => [
                        'id' => 5735776,
                        'name' => '123 Industries',
                        'currency' => 'EUR',
                    ],
                    'cost_budget' => NULL,
                    'cost_budget_include_expenses' => false,
                    'hourly_rate' => 100,
                    'fee' => NULL,
                ],
                [
                    'id' => 14307913,
                    'name' => 'Marketing Website',
                    'code' => 'MW',
                    'is_active' => true,
                    'bill_by' => 'Project',
                    'budget' => 50,
                    'budget_by' => 'project',
                    'notify_when_over_budget' => true,
                    'over_budget_notification_percentage' => 80,
                    'over_budget_notification_date' => NULL,
                    'show_budget_to_all' => false,
                    'created_at' => '2017-06-26T21:36:23Z',
                    'updated_at' => '2017-06-26T21:54:46Z',
                    'starts_on' => '2017-01-01',
                    'ends_on' => '2017-03-31',
                    'is_billable' => true,
                    'is_fixed_fee' => false,
                    'notes' => '',
                    'client' => [
                        'id' => 5735774,
                        'name' => 'ABC Corp',
                        'currency' => 'USD',
                    ],
                    'cost_budget' => NULL,
                    'cost_budget_include_expenses' => false,
                    'hourly_rate' => 100,
                    'fee' => NULL,
                ],
            ],
            'per_page' => 100,
            'total_pages' => 1,
            'total_entries' => 2,
            'next_page' => NULL,
            'previous_page' => NULL,
            'page' => 1,
            'links' => [
                'first' => 'https://api.harvestapp.com/v2/projects?page=1&per_page=100',
                'next' => NULL,
                'previous' => NULL,
                'last' => 'https://api.harvestapp.com/v2/projects?page=1&per_page=100',
            ],
        ];
    }
}