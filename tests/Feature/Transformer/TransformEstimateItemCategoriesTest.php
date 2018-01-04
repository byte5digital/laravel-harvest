<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

use Illuminate\Support\Collection;
use Byte5\LaravelHarvest\ApiResponse;
use Byte5\LaravelHarvest\Test\TestCase;
use Byte5\LaravelHarvest\Test\Fakes\FakeZttpResponse;
use Byte5\LaravelHarvest\Models\EstimateItemCategory;

class TransformEstimateItemCategoriesTest extends TestCase
{
    /** @test **/
    function it_can_transform_estimate_item_categories_api_responses_into_their_corresponding_models()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $collection = (new ApiResponse($apiResult, EstimateItemCategory::class))->toCollection();

        $this->assertTrue($collection instanceof Collection);
        $this->assertTrue($collection->first() instanceof EstimateItemCategory);
    }

    /** @test **/
    function it_can_transform_estimate_item_categories_api_responses_into_a_paginated_collection()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $paginatedCollection = (new ApiResponse($apiResult, EstimateItemCategory::class))
            ->toPaginatedCollection();

        $this->assertTrue($paginatedCollection['estimate_item_categories'] instanceof Collection);
        $this->assertTrue(array_key_exists('total_pages', $paginatedCollection));
    }

    /**
     * @return array
     */
    private function getFakeData()
    {
        return [
            'estimate_item_categories' => [
                [
                    'id' => 1378704,
                    'name' => 'Product',
                    'created_at' => '2017-06-26T20:41:00Z',
                    'updated_at' => '2017-06-26T20:41:00Z',
                ],
                [
                    'id' => 1378703,
                    'name' => 'Service',
                    'created_at' => '2017-06-26T20:41:00Z',
                    'updated_at' => '2017-06-26T20:41:00Z',
                ]
            ],
            'per_page' => 100,
            'total_pages' => 1,
            'total_entries' => 2,
            'next_page' => NULL,
            'previous_page' => NULL,
            'page' => 1,
            'links' => [
                'first' => 'https://api.harvestapp.com/v2/estimate_item_categories?page=1&per_page=100',
                'next' => NULL,
                'previous' => NULL,
                'last' => 'https://api.harvestapp.com/v2/estimate_item_categories?page=1&per_page=100',
            ],
        ];
    }
}