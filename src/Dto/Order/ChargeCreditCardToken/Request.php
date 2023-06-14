<?php
namespace Exigo\Dto\Order\ChargeCreditCardToken;

class Request extends \SmartDto\Dto
{
    public ?string $creditCardToken = null;
    public ?string $billingName = null;
    public ?string $billingAddress = null;
    public ?string $billingAddress2 = null;
    public ?string $billingCity = null;
    public ?string $billingState = null;
    public ?string $billingZip = null;
    public ?string $billingCountry = null;
    public ?string $cvcCode = null;
    public ?string $issueNumber = null;
    public ?int $creditCardType = null;
    public ?int $expirationMonth = null;
    public ?int $expirationYear = null;
    public ?int $orderID = null;
    public ?float $maxAmount = null;
    public ?int $merchantWarehouseIDOverride = null;
    public ?string $clientIPAddress = null;
    public ?string $otherData1 = null;
    public ?string $otherData2 = null;
    public ?string $otherData3 = null;
    public ?string $otherData4 = null;
    public ?string $otherData5 = null;
    public ?string $otherData6 = null;
    public ?string $otherData7 = null;
    public ?string $otherData8 = null;
    public ?string $otherData9 = null;
    public ?string $otherData10 = null;
    public ?string $orderKey = null;
}