<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

use Illuminate\Support\Collection;
use Byte5\LaravelHarvest\ApiResponse;
use Byte5\LaravelHarvest\Test\TestCase;
use Byte5\LaravelHarvest\Models\ExpenseCategory;
use Byte5\LaravelHarvest\Test\Fakes\FakeZttpResponse;

class TransformExpenseCategoriesTest extends TestCase
{
    /** @test **/
    function it_can_transform_expense_categories_api_responses_into_their_corresponding_models()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $collection = (new ApiResponse($apiResult, ExpenseCategory::class))->toCollection();;

        $this->assertTrue($collection instanceof Collection);
        $this->assertTrue($collection->first() instanceof ExpenseCategory);
    }

    /** @test **/
    function it_can_transform_expense_categories_api_responses_into_a_paginated_collection()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $paginatedCollection = (new ApiResponse($apiResult, ExpenseCategory::class))
            ->toPaginatedCollection();

        $this->assertTrue($paginatedCollection['expense_categories'] instanceof Collection);
        $this->assertTrue(array_key_exists('total_pages', $paginatedCollection));
    }

    /**
     * @return array
     */
    private function getFakeData()
    {
        return [
            'expense_categories' => [
                [
                    'id' => 4197501,
                    'name' => 'Lodging',
                    'unit_name' => NULL,
                    'unit_price' => NULL,
                    'is_active' => true,
                    'created_at' => '2017-06-27T15:01:32Z',
                    'updated_at' => '2017-06-27T15:01:32Z',
                ],
                [
                    'id' => 4195930,
                    'name' => 'Mileage',
                    'unit_name' => 'mile',
                    'unit_price' => 0.53500000000000003108624468950438313186168670654296875,
                    'is_active' => true,
                    'created_at' => '2017-06-26T20:41:00Z',
                    'updated_at' => '2017-06-26T20:41:00Z',
                ],
                [
                    'id' => 4195928,
                    'name' => 'Transportation',
                    'unit_name' => NULL,
                    'unit_price' => NULL,
                    'is_active' => true,
                    'created_at' => '2017-06-26T20:41:00Z',
                    'updated_at' => '2017-06-26T20:41:00Z',
                ],
                [
                    'id' => 4195926,
                    'name' => 'Meals',
                    'unit_name' => NULL,
                    'unit_price' => NULL,
                    'is_active' => true,
                    'created_at' => '2017-06-26T20:41:00Z',
                    'updated_at' => '2017-06-26T20:41:00Z',
                ],
            ],
            'per_page' => 100,
            'total_pages' => 1,
            'total_entries' => 4,
            'next_page' => NULL,
            'previous_page' => NULL,
            'page' => 1,
            'links' => [
                'first' => 'https://api.harvestapp.com/v2/expense_categories?page=1&per_page=100',
                'next' => NULL,
                'previous' => NULL,
                'last' => 'https://api.harvestapp.com/v2/expense_categories?page=1&per_page=100',
            ],
        ];
    }
}