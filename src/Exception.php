<?php
namespace Exigo;

use \Exigo\Helpers\ArrayWorks;

class Exception extends \Exception
{
    protected static $messageTransformer = null;
    /**
     *  @description    Trims values then throws error on empty
     *  @returns        Trimmed value of the original $value parameter
     */
    public static function onEmpty($value, string $message, int $code = 403, Callable $func = null)
    {
        $value = ArrayWorks::trimAll($value);
        if($func) {
            $value = $func($value);
            if(!$value)
                throw new Exception(
                    ((self::$messageTransformer)? self::$messageTransformer($message, $code) : $message),
                    $code
                );
        } else {
            if(empty($value))
                throw new Exception(
                    ((self::$messageTransformer)? self::$messageTransformer($message, $code) : $message),
                    $code
                );
        }

        return $value;
    }
    /**
     *  @description    Allows for transforming the message (such as language translations)
     */
    public static function setTransformer(Callable | null $func)
    {
        self::$messageTransformer = $func;
    }
}