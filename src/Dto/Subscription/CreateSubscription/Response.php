<?php
namespace Exigo\Dto\Subscription\CreateSubscription;

class Response extends \SmartDto\Dto
{
    public ?int $autoOrderID = null;
    public ?string $description = null;
    public ?float $total = null;
    public ?float $subTotal = null;
    public ?float $taxTotal = null;
    public ?float $shippingTotal = null;
    public ?float $discountTotal = null;
    public ?float $weightTotal = null;
    public ?float $businessVolumeTotal = null;
    public ?float $commissionableVolumeTotal = null;
    public ?float $other1Total = null;
    public ?float $other2Total = null;
    public ?float $other3Total = null;
    public ?float $other4Total = null;
    public ?float $other5Total = null;
    public ?float $other6Total = null;
    public ?float $other7Total = null;
    public ?float $other8Total = null;
    public ?float $other9Total = null;
    public ?float $other10Total = null;
    public ?float $shippingTax = null;
    public ?float $orderTax = null;
    public ?array $detailsOrder = [];
    /**
     *	@description	
     *	@param	
     */
    protected function beforeConstruct($array)
    {
        $array['orderDetail'] = array_map(fn($v) => new OrderDetail($v), $array['orderDetail']?? []);
        return $array;
    }
}