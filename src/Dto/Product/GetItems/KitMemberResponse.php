<?php
namespace Exigo\Dto\Product\GetItems;

use \Exigo\Dto\Product\GetItems\KitMemberItemResponse;

class KitMemberResponse extends \SmartDto\Dto
{
    public ?string $Description = null;
    public ?array $KitMemberItems = [];
    /**
     *	@description	
     *	@param	
     */
    protected function beforeConstruct($array)
    {
        $array['KitMemberItems'] = array_map(fn($v) => new KitMemberItemResponse($v), $array['KitMemberItems']?? []);
        return $array;
    }
}