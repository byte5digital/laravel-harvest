<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

use Illuminate\Support\Collection;
use Byte5\LaravelHarvest\ApiResponse;
use Byte5\LaravelHarvest\Test\TestCase;
use Byte5\LaravelHarvest\Models\Expense;
use Byte5\LaravelHarvest\Test\Fakes\FakeZttpResponse;

class TransformExpensesTest extends TestCase
{
    use MigrationSetup;

    /** @test **/
    function it_can_transform_expenses_api_responses_into_their_corresponding_models()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $collection = (new ApiResponse($apiResult, Expense::class))->toCollection();;

        $this->assertTrue($collection instanceof Collection);
        $this->assertTrue($collection->first() instanceof Expense);
    }

    /** @test **/
    function it_can_transform_expenses_api_responses_into_a_paginated_collection()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $paginatedCollection = (new ApiResponse($apiResult, Expense::class))
            ->toPaginatedCollection();

        $this->assertTrue($paginatedCollection['expenses'] instanceof Collection);
        $this->assertTrue(array_key_exists('total_pages', $paginatedCollection));
    }

    /**
     * @return array
     */
    private function getFakeData()
    {
        return [
            'expenses' => [
                [
                    'id' => 15296442,
                    'notes' => 'Lunch with client',
                    'total_cost' => 33.35000000000000142108547152020037174224853515625,
                    'units' => 1,
                    'is_closed' => false,
                    'is_locked' => true,
                    'is_billed' => true,
                    'locked_reason' => 'Expense is invoiced.',
                    'spent_date' => '2017-03-03',
                    'created_at' => '2017-06-27T15:09:54Z',
                    'updated_at' => '2017-06-27T16:47:14Z',
                    'billable' => true,
                    'receipt' => [
                        'url' => 'https://{ACCOUNT_SUBDOMAIN}.harvestapp.com/expenses/15296442/receipt',
                        'file_name' => 'lunch_receipt.gif',
                        'file_size' => 39410,
                        'content_type' => 'image/gif',
                    ],
                    'user' => [
                        'id' => 1782959,
                        'name' => 'Kim Allen',
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
                    'project' => [
                        'id' => 14307913,
                        'name' => 'Marketing Website',
                        'code' => 'MW',
                    ],
                    'expense_category' => [
                        'id' => 4195926,
                        'name' => 'Meals',
                        'unit_price' => NULL,
                        'unit_name' => NULL,
                    ],
                    'client' => [
                        'id' => 5735774,
                        'name' => 'ABC Corp',
                        'currency' => 'USD',
                    ],
                    'invoice' => [
                        'id' => 13150403,
                        'number' => '1001',
                    ],
                ],
                [
                    'id' => 15296423,
                    'notes' => 'Hotel stay for meeting',
                    'total_cost' => 100,
                    'units' => 1,
                    'is_closed' => true,
                    'is_locked' => true,
                    'is_billed' => false,
                    'locked_reason' => 'The project is locked for this time period.',
                    'spent_date' => '2017-03-01',
                    'created_at' => '2017-06-27T15:09:17Z',
                    'updated_at' => '2017-06-27T16:47:14Z',
                    'billable' => true,
                    'receipt' => NULL,
                    'user' => [
                        'id' => 1782959,
                        'name' => 'Kim Allen',
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
                    'project' => [
                        'id' => 14308069,
                        'name' => 'Online Store - Phase 1',
                        'code' => 'OS1',
                    ],
                    'expense_category' => [
                        'id' => 4197501,
                        'name' => 'Lodging',
                        'unit_price' => NULL,
                        'unit_name' => NULL,
                    ],
                    'client' => [
                        'id' => 5735776,
                        'name' => '123 Industries',
                        'currency' => 'EUR',
                    ],
                    'invoice' => NULL,
                ],
            ],
            'per_page' => 100,
            'total_pages' => 1,
            'total_entries' => 2,
            'next_page' => NULL,
            'previous_page' => NULL,
            'page' => 1,
            'links' => [
                'first' => 'https://api.harvestapp.com/v2/expenses?page=1&per_page=100',
                'next' => NULL,
                'previous' => NULL,
                'last' => 'https://api.harvestapp.com/v2/expenses?page=1&per_page=100',
            ]
        ];
    }
}