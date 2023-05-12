<?php
namespace Exigo\Dto\Product\GetItems;

use \Exigo\Dto\Product\GetItems\ {
    ItemMemberResponse,
    KitMemberResponse
};

class Item extends \Exigo\Dto\Response
{
    public ?string $ItemCode = '';
    public ?string $Description = '';
    public ?float $Price = 0;
    public ?float $Weight = 0;
    public ?float $CommissionableVolume = 0;
    public ?float $BusinessVolume = 0;
    public ?float $Other1Price = 0;
    public ?float $Other2Price = 0;
    public ?float $Other3Price = 0;
    public ?float $Other4Price = 0;
    public ?float $Other5Price = 0;
    public ?float $Other6Price = 0;
    public ?float $Other7Price = 0;
    public ?float $Other8Price = 0;
    public ?float $Other9Price = 0;
    public ?float $Other10Price = 0;
    public ?string $Category = '';
    public ?int $CategoryID = null;
    public ?string $TinyPicture = '';
    public ?string $SmallPicture = '';
    public ?string $LargePicture = '';
    public ?string $ShortDetail = '';
    public ?string $ShortDetail2 = '';
    public ?string $ShortDetail3 = '';
    public ?string $ShortDetail4 = '';
    public ?string $LongDetail = '';
    public ?string $LongDetail2 = '';
    public ?string $LongDetail3 = '';
    public ?string $LongDetail4 = '';
    public $InventoryStatus = null;
    public ?int $StockLevel = null;
    public ?int $AvailableStockLevel = null;
    public ?int $MaxAllowedOnOrder = null;
    public ?string $Field1 = '';
    public ?string $Field2 = '';
    public ?string $Field3 = '';
    public ?string $Field4 = '';
    public ?string $Field5 = '';
    public ?string $Field6 = '';
    public ?string $Field7 = '';
    public ?string $Field8 = '';
    public ?string $Field9 = '';
    public ?string $Field10 = '';
    public ?bool $OtherCheck1 = null;
    public ?bool $OtherCheck2 = null;
    public ?bool $OtherCheck3 = null;
    public ?bool $OtherCheck4 = null;
    public ?bool $OtherCheck5 = null;
    public ?bool $IsVirtual = null;
    public ?bool $AllowOnAutoOrder = null;
    public ?bool $IsGroupMaster = null;
    public ?string $GroupDescription = '';
    public ?string $GroupMembersDescription = '';
    public ?array $GroupMembers = [];
    public ?bool $IsDynamicKitMaster = null;
    public ?bool $HideFromSearch = null;
    public ?array $KitMembers = [];
    public ?float $TaxablePrice = 0;
    public ?float $ShippingPrice = 0;

    /**
     *	@description	
     *	@param	
     */
    protected function beforeConstruct($array)
    {
        $array['GroupMembers'] = array_map(fn($v) => new ItemMemberResponse($v), ($array['GroupMembers']?? []));
        $array['KitMembers'] = array_map(fn($v) => new KitMemberResponse($v), ($array['KitMembers']?? []));
        return $array;
    }
}