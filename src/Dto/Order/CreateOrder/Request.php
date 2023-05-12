<?php
namespace Exigo\Dto\Order\CreateOrder;

class Request extends \SmartDto\Dto
{
    public ?int $customerID = null;
    public ?string $orderStatus = null;
    public ?string $orderDate = null;
    public ?string $currencyCode = null;
    public ?int $warehouseID = null;
    public ?int $shipMethodID = null;
    public ?int $priceType = null;
    public ?string $firstName = null;
    public ?string $lastName = null;
    public ?string $company = null;
    public ?string $address1 = null;
    public ?string $address2 = null;
    public ?string $address3 = null;
    public ?string $city = null;
    public ?string $zip = null;
    public ?string $county = null;
    public ?string $email = null;
    public ?string $phone = null;
    public ?string $notes = null;
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
    public ?string $orderType = null;
    public ?int $transferVolumeToID = null;
    public ?int $returnOrderID = null;
    public ?string $overwriteExistingOrder = null;
    public ?int $existingOrderID = null;
    public ?int $partyID = null;
    public ?string $details = null;
    public ?string $suppressPackSlipPrice = null;
    public ?string $transferVolumeToKey = null;
    public ?string $returnOrderKey = null;
    public ?string $existingOrderKey = null;
    public ?string $customerKey = null;
}