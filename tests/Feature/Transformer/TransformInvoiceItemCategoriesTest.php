<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

use Illuminate\Support\Collection;
use Byte5\LaravelHarvest\ApiResponse;
use Byte5\LaravelHarvest\Test\TestCase;
use Byte5\LaravelHarvest\Models\InvoiceItemCategory;
use Byte5\LaravelHarvest\Test\Fakes\FakeZttpResponse;

class TransformInvoiceItemCategoriesTest extends TestCase
{
    /** @test **/
    public function it_can_transform_invoice_item_categories_api_responses_into_their_corresponding_models()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $collection = (new ApiResponse($apiResult, InvoiceItemCategory::class))->toCollection();

        $this->assertTrue($collection instanceof Collection);
        $this->assertTrue($collection->first() instanceof InvoiceItemCategory);
    }

    /** @test **/
    public function it_can_transform_invoice_item_categories_api_responses_into_a_paginated_collection()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $paginatedCollection = (new ApiResponse($apiResult, InvoiceItemCategory::class))
            ->toPaginatedCollection();

        $this->assertTrue($paginatedCollection['invoice_item_categories'] instanceof Collection);
        $this->assertTrue(array_key_exists('total_pages', $paginatedCollection));
    }

    /**
     * @return array
     */
    private function getFakeData()
    {
        return [
            'invoice_item_categories' => [
                [
                    'id' => 1466293,
                    'name' => 'Product',
                    'use_as_service' => false,
                    'use_as_expense' => true,
                    'created_at' => '2017-06-26T20:41:00Z',
                    'updated_at' => '2017-06-26T20:41:00Z',
                ],
                [
                    'id' => 1466292,
                    'name' => 'Service',
                    'use_as_service' => true,
                    'use_as_expense' => false,
                    'created_at' => '2017-06-26T20:41:00Z',
                    'updated_at' => '2017-06-26T20:41:00Z',
                ],
            ],
            'per_page' => 100,
            'total_pages' => 1,
            'total_entries' => 2,
            'next_page' => null,
            'previous_page' => null,
            'page' => 1,
            'links' => [
                'first' => 'https://api.harvestapp.com/v2/invoice_item_categories?page=1&per_page=100',
                'next' => null,
                'previous' => null,
                'last' => 'https://api.harvestapp.com/v2/invoice_item_categories?page=1&per_page=100',
            ],
        ];
    }
}
