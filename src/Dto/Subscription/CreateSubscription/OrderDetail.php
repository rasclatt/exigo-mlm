<?php
namespace Exigo\Dto\Subscription\CreateSubscription;

class OrderDetail extends \SmartDto\Dto
{
    public ?int $orderDetailID = null;
    public ?int $parentOrderDetailID = null;
    public ?string $itemCode = null;
    public ?string $description = null;
    public ?float $quantity = null;
    public ?float $priceEach = null;
    public ?float $priceTotal = null;
    public ?float $tax = null;
    public ?float $weightEach = null;
    public ?float $weight = null;
    public ?float $businessVolumeEach = null;
    public ?float $businesVolume = null;
    public ?float $commissionableVolumeEach = null;
    public ?float $commissionableVolume = null;
    public ?float $other1Each = null;
    public ?float $other1 = null;
    public ?float $other2Each = null;
    public ?float $other2 = null;
    public ?float $other3Each = null;
    public ?float $other3 = null;
    public ?float $other4Each = null;
    public ?float $other4 = null;
    public ?float $other5Each = null;
    public ?float $other5 = null;
    public ?float $other6Each = null;
    public ?float $other6 = null;
    public ?float $other7Each = null;
    public ?float $other7 = null;
    public ?float $other8Each = null;
    public ?float $other8 = null;
    public ?float $other9Each = null;
    public ?float $other9 = null;
    public ?float $other10Each = null;
    public ?float $other10 = null;
    public ?string $parentItemCode = null;
    public ?float $taxable = null;
    public ?float $fedTax = null;
    public ?float $stateTax = null;
    public ?float $cityTax = null;
    public ?float $cityLocalTax = null;
    public ?float $countyTax = null;
    public ?float $countyLocalTax = null;
    public ?float $manualTax = null;
    public ?bool $isStateTaxOverride = null;
    public ?int $orderLine = null;
    public ?int $reference1 = null;
    public ?float $shippingPriceEach = null;
    public ?float $HandlingFee = null;
}