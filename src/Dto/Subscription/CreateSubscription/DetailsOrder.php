<?php
namespace Exigo\Dto\Subscription\CreateSubscription;

class DetailsOrder extends \SmartDto\Dto
{
    public ?string $itemCode = null;
    public $orderDetailID = null;
    public $parentOrderDetailID = null;
    public ?float $quantity = null;
    public ?string $parentItemCode = null;
    public ?float $priceEachOverride = null;
    public ?float $taxableEachOverride = null;
    public ?float $shippingPriceEachOverride = null;
    public ?float $businessVolumeEachOverride = null;
    public ?float $commissionableVolumeEachOverride = null;
    public ?float $other1EachOverride = null;
    public ?float $other2EachOverride = null;
    public ?float $other3EachOverride = null;
    public ?float $other4EachOverride = null;
    public ?float $other5EachOverride = null;
    public ?float $other6EachOverride = null;
    public ?float $other7EachOverride = null;
    public ?float $other8EachOverride = null;
    public ?float $other9EachOverride = null;
    public ?float $other10EachOverride = null;
    public ?string $descriptionOverride = null;
    public ?string $reference1 = null;
    public $advancedAutoOptions = null;
    public ?int $orderLine = null;
}