<?php
namespace Exigo\Dto\Order\CreateOrder;

class Response extends \Exigo\Dto\Response
{
    public ?int $orderID = null;
    public ?string $total = null;
    public ?string $subTotal = null;
    public ?string $taxTotal = null;
    public ?string $shippingTotal = null;
    public ?string $discountTotal = null;
    public ?string $weightTotal = null;
    public ?string $businessVolumeTotal = null;
    public ?string $commissionableVolumeTotal = null;
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
    public ?string $shippingTax = null;
    public ?string $orderTax = null;
    public ?string $handlingFeeTotal = null;
    public ?string $details = null;
    public ?string $warnings = null;
    public ?string $orderKey = null;
}