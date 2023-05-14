<?php
namespace Exigo\Dto\Product\GetItems;

class ItemMemberResponse extends \SmartDto\Dto
{
    public ?string $itemCode = null;
    public ?string $memberDescription = null;
    public ?string $itemDescription = null;
    public $inventoryStatus = null;
    public ?int $stockLevel = null;
    public ?int $availableStockLevel = null;
}