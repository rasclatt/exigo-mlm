<?php
namespace Exigo\Helpers;

class ArrayWorks
{
    /**
     *	@description	Recurse trim all values
     */
    public static function trimAll($value)
    {
        if(is_iterable($value)) {
            foreach($value as $k => $v) {
                if(is_object($value))
                    $value->{$k} = self::trimAll($v);
                else
                    $value[$k] = self::trimAll($v);
            }
        } else {
            if(is_string($value)) {
                return trim($value);
            }
        }
        return $value;
    }
}