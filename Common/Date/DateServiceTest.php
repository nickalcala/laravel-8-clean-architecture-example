<?php

namespace Common\Date;

use Tests\TestCase;

class DateServiceTest extends TestCase
{
    public function test_can_get_datetime_moment()
    {
        $service = $this->app->make(IDateService::class);
        $moment = $service->getMoment(date('Y-m-d H:i:s', strtotime('-1 hours')));
        self::assertEquals('1 hour ago', $moment);
    }
}
