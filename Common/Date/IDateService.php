<?php

namespace Common\Date;

/**
 * Sample class that can be used throughout the app.
 * @package Common
 */
interface IDateService
{
    public function getMoment(string $datetime): string;
}
