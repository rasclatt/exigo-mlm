<?php
namespace Exigo\Dto\Product\GetItems;

class ItemMemberResponse extends \SmartDto\Dto
{
    public ?string $ItemCode = null;
    public ?string $MemberDescription = null;
    public ?string $ItemDescription = null;
    public $InventoryStatus = null;
    public ?int $StockLevel = null;
    public ?int $AvailableStockLevel = null;
}