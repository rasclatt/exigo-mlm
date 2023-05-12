<?php
namespace Exigo\Dto\Product\GetItems;

use \Exigo\Dto\Product\GetItems\Item;

class Response extends \SmartDto\Dto
{
    public array $Items = [];
    /**
     *	@description	
     *	@param	
     */
    protected function beforeConstruct($array)
    {
        return array_map(fn($v) => new Item($v), $array['Items']);
    }
}