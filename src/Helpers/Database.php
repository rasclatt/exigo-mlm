<?php
namespace Exigo\Helpers;

abstract class Database implements \Exigo\Interfaces\Database
{
    protected static $con = null;
    protected $query;
    /**
     *	@description	
     *	@param	
     */
    public function __construct($connection = null)
    {
        if(!self::$con && $connection)
            self::$con = $connection;
    }
}