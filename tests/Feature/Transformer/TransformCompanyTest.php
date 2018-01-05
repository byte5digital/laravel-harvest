<?php

namespace Byte5\LaravelHarvest\Test\Feature\Transformer;

use Illuminate\Support\Collection;
use Byte5\LaravelHarvest\ApiResponse;
use Byte5\LaravelHarvest\Test\TestCase;
use Byte5\LaravelHarvest\Models\Company;
use Byte5\LaravelHarvest\Test\Fakes\FakeZttpResponse;

class TransformCompanyTest extends TestCase
{
    /** @test **/
    public function it_can_transform_companies_api_responses_into_their_corresponding_models()
    {
        $apiResult = new FakeZttpResponse($this->getFakeData());

        $collection = (new ApiResponse($apiResult, Company::class))->toCollection();

        $this->assertTrue($collection instanceof Collection);
        $this->assertTrue($collection->first() instanceof Company);
    }

    /**
     * @return array
     */
    private function getFakeData()
    {
        return [
            'base_uri' => 'https://{ACCOUNT_SUBDOMAIN}.harvestapp.com',
            'full_domain' => '{ACCOUNT_SUBDOMAIN}.harvestapp.com',
            'name' => 'API Examples',
            'is_active' => true,
            'week_start_day' => 'Monday',
            'wants_timestamp_timers' => true,
            'time_format' => 'hours_minutes',
            'plan_type' => 'sponsored',
            'expense_feature' => true,
            'invoice_feature' => true,
            'estimate_feature' => true,
            'approval_required' => true,
            'clock' => '12h',
            'decimal_symbol' => '.',
            'thousands_separator' => ',',
            'color_scheme' => 'orange',
        ];
    }
}
