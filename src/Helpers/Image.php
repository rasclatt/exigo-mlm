<?php
namespace Exigo\Helpers;

class Image
{
    private static string $path = '';
    /**
     *	@description	
     *	@param	
     */
    public static function path(string $fileName)
    {
        return self::$path.$fileName;
    }
}