<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

use Illuminate\Support\Collection;
use Byte5\LaravelHarvest\ApiResponse;
use Byte5\LaravelHarvest\Models\User;
use Byte5\LaravelHarvest\Test\TestCase;
use Byte5\LaravelHarvest\Test\Fakes\FakeZttpResponse;

class TransformUsersTest extends TestCase
{
    /** @test **/
    public function it_can_transform_users_api_responses_into_their_corresponding_models()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $collection = (new ApiResponse($apiResult, User::class))->toCollection();

        $this->assertTrue($collection instanceof Collection);
        $this->assertTrue($collection->first() instanceof User);
    }

    /** @test **/
    public function it_can_transform_users_api_responses_into_a_paginated_collection()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $paginatedCollection = (new ApiResponse($apiResult, User::class))
            ->toPaginatedCollection();

        $this->assertTrue($paginatedCollection['users'] instanceof Collection);
        $this->assertTrue(array_key_exists('total_pages', $paginatedCollection));
    }

    /**
     * @return array
     */
    private function getFakeData()
    {
        return [
            'users' => [
                [
                    'id' => 1782974,
                    'first_name' => 'Jim',
                    'last_name' => 'Allen',
                    'email' => 'jimallen@example.com',
                    'telephone' => '',
                    'timezone' => 'Mountain Time (US & Canada)',
                    'has_access_to_all_future_projects' => false,
                    'is_contractor' => false,
                    'is_admin' => false,
                    'is_project_manager' => false,
                    'can_see_rates' => false,
                    'can_create_projects' => false,
                    'can_create_invoices' => false,
                    'is_active' => true,
                    'created_at' => '2017-06-26T22:34:41Z',
                    'updated_at' => '2017-06-26T22:34:52Z',
                    'weekly_capacity' => 126000,
                    'default_hourly_rate' => 100,
                    'cost_rate' => 50,
                    'roles' => [
                        0 => 'Developer',
                    ],
                    'avatar_url' => 'https://cache.harvestapp.com/assets/profile_images/abraj_albait_towers.png?1498516481',
                ],
                [
                    'id' => 1782959,
                    'first_name' => 'Kim',
                    'last_name' => 'Allen',
                    'email' => 'kimallen@example.com',
                    'telephone' => '',
                    'timezone' => 'Eastern Time (US & Canada]',
                    'has_access_to_all_future_projects' => true,
                    'is_contractor' => false,
                    'is_admin' => false,
                    'is_project_manager' => true,
                    'can_see_rates' => false,
                    'can_create_projects' => false,
                    'can_create_invoices' => false,
                    'is_active' => true,
                    'created_at' => '2017-06-26T22:15:45Z',
                    'updated_at' => '2017-06-26T22:32:52Z',
                    'weekly_capacity' => 126000,
                    'default_hourly_rate' => 100,
                    'cost_rate' => 50,
                    'roles' => [
                        0 => 'Designer',
                    ],
                    'avatar_url' => 'https://cache.harvestapp.com/assets/profile_images/cornell_clock_tower.png?1498515345',
                ],
            ],
            'per_page' => 100,
            'total_pages' => 1,
            'total_entries' => 3,
            'next_page' => null,
            'previous_page' => null,
            'page' => 1,
            'links' => [
                'first' => 'https://api.harvestapp.com/v2/users?page=1&per_page=100',
                'next' => null,
                'previous' => null,
                'last' => 'https://api.harvestapp.com/v2/users?page=1&per_page=100',
            ],
        ];
    }
}
