<?php

namespace Common\Date;

use Carbon\Carbon;

/**
 * Sample class that can be used throughout the app.
 * @package Common\Date
 */
class DateService implements IDateService
{
    public function getMoment(string $datetime): string
    {
        return Carbon::parse($datetime)->diffForHumans();
    }
}
