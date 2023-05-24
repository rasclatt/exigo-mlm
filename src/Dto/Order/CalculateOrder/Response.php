<?php
namespace Exigo\Dto\Order\CalculateOrder;

class Response extends \Exigo\Dto\Response
{
    public ?float $total = null;
    public ?float $subTotal = null;
    public ?float $taxTotal = null;
    public ?float $shippingTotal = null;
    public ?float $discountTotal = null;
    public ?float $discountPercent = null;
    public ?float $weightTotal = null;
    public ?int $businessVolumeTotal = null;
    public ?int $commissionableVolumeTotal = null;
    public ?string $other1Total = null;
    public ?string $other2Total = null;
    public ?string $other3Total = null;
    public ?string $other4Total = null;
    public ?string $other5Total = null;
    public ?string $other6Total = null;
    public ?string $other7Total = null;
    public ?string $other8Total = null;
    public ?string $other9Total = null;
    public ?string $other10Total = null;
    public ?string $other11 = null;
    public ?string $other12 = null;
    public ?string $other13 = null;
    public ?string $other14 = null;
    public ?string $other15 = null;
    public ?string $other16 = null;
    public ?string $other17 = null;
    public ?string $other18 = null;
    public ?string $other19 = null;
    public ?string $other20 = null;
    public ?float $shippingTax = null;
    public ?float $orderTax = null;
    public ?float $fedTaxTotal = null;
    public ?float $stateTaxTotal = null;
    public array $details = [];
    public array $shipMethods = [];
    public array $warnings = [];
    public ?string $trace = null;
    public ?float $handlingFeeTotal = null;
}