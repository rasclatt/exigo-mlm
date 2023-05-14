
<?php
namespace Exigo\Dto\Product\GetItems;

class KitMemberItemResponse extends \SmartDto\Dto
{
    public ?string $itemCode = null;
    public ?string $description = null;
    public $inventoryStatus  = null;
}