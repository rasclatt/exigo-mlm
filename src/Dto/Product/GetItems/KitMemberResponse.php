<?php
namespace Exigo\Dto\Product\GetItems;

use \Exigo\Dto\Product\GetItems\KitMemberItemResponse;

class KitMemberResponse extends \SmartDto\Dto
{
    public ?string $description = null;
    public ?array $kitMemberItems = [];
    /**
     *	@description	
     *	@param	
     */
    protected function beforeConstruct($array)
    {
        $array['kitMemberItems'] = array_map(fn($v) => new KitMemberItemResponse($v), $array['kitMemberItems']?? []);
        return $array;
    }
}