<?php
namespace Exigo\Dto\Subscription\GetSubscriptions;

class AutoOrderDetails extends \SmartDto\Dto
{
    public ?string $itemCode = null;
    public ?string $description = null;
    public ?string $parentItemCode = null;
    public ?float $quantity = null;
    public ?float $priceEach = null;
    public ?float $priceTotal = null;
    public ?float $businessVolumeEach = null;
    public ?float $businesVolume = null;
    public ?float $commissionableVolumeEach = null;
    public ?float $commissionableVolume = null;
    public ?float $priceEachOverride = null;
    public ?float $taxableEachOverride = null;
    public ?float $shippingPriceEachOverride = null;
    public ?float $businessVolumeEachOverride = null;
    public ?float $commissionableVolumeEachOverride = null;
    public ?string $reference1 = null;
    public ?string $detailStartDate = null;
    public ?string $detailEndDate = null;
    public ?int $detailInterval = null;
    public ?int $orderLine = null;
}