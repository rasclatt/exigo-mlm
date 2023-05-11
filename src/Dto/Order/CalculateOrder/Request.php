<?php
namespace Exigo\Dto\Order\CalculateOrder;

class Request extends \SmartDto\Dto
{
    public ?string $currencyCode = null;
    public ?int $warehouseID = null;
    public ?int $shipMethodID = null;
    public ?int $priceType = null;
    public ?string $address1 = null;
    public ?string $address2 = null;
    public ?string $address3 = null;
    public ?string $city = null;
    public ?string $state = null;
    public ?string $zip = null;
    public ?string $country = null;
    public ?string $county = null;
    public ?int $customerID = null;
    public ?string $details = null;
    public ?bool $returnShipMethods = null;
    public ?int $partyID = null;
    public ?string $customerKey = null;
    public ?string $orderType = null;
}