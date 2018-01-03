<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

use Illuminate\Support\Collection;
use Byte5\LaravelHarvest\ApiResponse;
use Byte5\LaravelHarvest\Test\TestCase;
use Byte5\LaravelHarvest\Models\Contact;
use Byte5\LaravelHarvest\Test\Fakes\FakeZttpResponse;

class TransformContactsTest extends TestCase
{
    use MigrationSetup;

    /** @test **/
    function it_can_transform_contacts_api_responses_into_their_corresponding_models()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $collection = (new ApiResponse($apiResult, Contact::class))->toCollection();;

        $this->assertTrue($collection instanceof Collection);
        $this->assertTrue($collection->first() instanceof Contact);
    }

    /** @test **/
    function it_can_transform_contacts_api_responses_into_a_paginated_collection()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $paginatedCollection = (new ApiResponse($apiResult, Contact::class))
            ->toPaginatedCollection();

        $this->assertTrue($paginatedCollection['contacts'] instanceof Collection);
        $this->assertTrue(array_key_exists('total_pages', $paginatedCollection));
    }

    /**
     * @return array
     */
    private function getFakeData()
    {
        return [
            'contacts' => [
                [
                    'id' => 4706479,
                    'title' => 'Owner',
                    'first_name' => 'Jane',
                    'last_name' => 'Doe',
                    'email' => 'janedoe@example.com',
                    'phone_office' => '(203) 697-8885',
                    'phone_mobile' => '(203) 697-8886',
                    'fax' => '(203) 697-8887',
                    'created_at' => '2017-06-26T21:20:07Z',
                    'updated_at' => '2017-06-26T21:27:07Z',
                    'client' => [
                        'id' => 5735774,
                        'name' => 'ABC Corp',
                    ],
                ],
                [
                    'id' => 4706453,
                    'title' => 'Manager',
                    'first_name' => 'Richard',
                    'last_name' => 'Roe',
                    'email' => 'richardroe@example.com',
                    'phone_office' => '(318) 515-5905',
                    'phone_mobile' => '(318) 515-5906',
                    'fax' => '(318) 515-5907',
                    'created_at' => '2017-06-26T21:06:55Z',
                    'updated_at' => '2017-06-26T21:27:20Z',
                    'client' => [
                        'id' => 5735776,
                        'name' => '123 Industries',
                    ]
                ],
            ],
            'per_page' => 100,
            'total_pages' => 1,
            'total_entries' => 2,
            'next_page' => NULL,
            'previous_page' => NULL,
            'page' => 1,
            'links' => [
              'first' => 'https://api.harvestapp.com/v2/contacts?page=1&per_page=100',
              'next' => NULL,
              'previous' => NULL,
              'last' => 'https://api.harvestapp.com/v2/contacts?page=1&per_page=100',
            ]
        ];
    }
}