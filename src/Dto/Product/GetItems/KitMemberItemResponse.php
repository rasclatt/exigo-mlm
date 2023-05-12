
<?php
namespace Exigo\Dto\Product\GetItems;

class KitMemberItemResponse extends \SmartDto\Dto
{
    public ?string $ItemCode = null;
    public ?string $Description = null;
    public $InventoryStatus  = null;
}