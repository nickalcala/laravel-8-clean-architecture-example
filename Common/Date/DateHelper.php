<?php

namespace Common\Date;

use Illuminate\Support\Facades\Facade;

/**
 * Class DateServiceFacade
 * @method static string getMoment(string $datetime)
 * @package Common\Date
 */
class DateHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return IDateService::class;
    }
}
