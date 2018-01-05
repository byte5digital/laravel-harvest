<?php

namespace Byte5\LaravelHarvest\Test\Unit;

use Byte5\LaravelHarvest\Harvest;
use Byte5\LaravelHarvest\Test\TestCase;

class ApiManagerTest extends TestCase
{
    /** @test **/
    public function the_endpoint_is_cleared_before_a_new_request_is_made()
    {
        Harvest::clients()->get();

        $this->assertNull(Harvest::getEndpoint());
    }
}
