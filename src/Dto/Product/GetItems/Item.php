<?php
namespace Exigo\Dto\Product\GetItems;

use \Exigo\Dto\Product\GetItems\ {
    ItemMemberResponse,
    KitMemberResponse
};

class Item extends \Exigo\Dto\Response
{
    public ?string $itemCode = '';
    public ?string $description = '';
    public ?float $price = 0;
    public ?float $weight = 0;
    public ?float $commissionableVolume = 0;
    public ?float $businessVolume = 0;
    public ?float $other1Price = 0;
    public ?float $other2Price = 0;
    public ?float $other3Price = 0;
    public ?float $other4Price = 0;
    public ?float $other5Price = 0;
    public ?float $other6Price = 0;
    public ?float $other7Price = 0;
    public ?float $other8Price = 0;
    public ?float $other9Price = 0;
    public ?float $other10Price = 0;
    public ?string $category = '';
    public ?int $categoryID = null;
    public ?string $tinyPicture = '';
    public ?string $smallPicture = '';
    public ?string $largePicture = '';
    public ?string $shortDetail = '';
    public ?string $shortDetail2 = '';
    public ?string $shortDetail3 = '';
    public ?string $shortDetail4 = '';
    public ?string $longDetail = '';
    public ?string $longDetail2 = '';
    public ?string $longDetail3 = '';
    public ?string $longDetail4 = '';
    public $inventoryStatus = null;
    public ?int $stockLevel = null;
    public ?int $availableStockLevel = null;
    public ?int $maxAllowedOnOrder = null;
    public ?string $field1 = '';
    public ?string $field2 = '';
    public ?string $field3 = '';
    public ?string $field4 = '';
    public ?string $field5 = '';
    public ?string $field6 = '';
    public ?string $field7 = '';
    public ?string $field8 = '';
    public ?string $field9 = '';
    public ?string $field10 = '';
    public ?bool $otherCheck1 = null;
    public ?bool $otherCheck2 = null;
    public ?bool $otherCheck3 = null;
    public ?bool $otherCheck4 = null;
    public ?bool $otherCheck5 = null;
    public ?bool $isVirtual = null;
    public ?bool $allowOnAutoOrder = null;
    public ?bool $isGroupMaster = null;
    public ?string $groupDescription = '';
    public ?string $groupMembersDescription = '';
    public ?array $groupMembers = [];
    public ?bool $isDynamicKitMaster = null;
    public ?bool $hideFromSearch = null;
    public ?array $kitMembers = [];
    public ?float $taxablePrice = 0;
    public ?float $shippingPrice = 0;

    /**
     *	@description	
     *	@param	
     */
    protected function beforeConstruct($array)
    {
        $array['groupMembers'] = array_map(fn($v) => new ItemMemberResponse($v), ($array['groupMembers']?? []));
        $array['kitMembers'] = array_map(fn($v) => new KitMemberResponse($v), ($array['kitMembers']?? []));
        return $array;
    }
}