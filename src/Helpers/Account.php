<?php
namespace Exigo\Helpers;

class Account
{
    public static string $offset = '-8:00';

    public static function getDate(string $date): string
    {
        return (new \DateTime($date, new \DateTimeZone(self::$offset)))->format('Y-m-d\TH:i:sP');
    }
}