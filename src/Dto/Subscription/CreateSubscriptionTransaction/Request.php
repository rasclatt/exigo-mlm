<?php
namespace Exigo\Dto\Subscription\CreateSubscriptionTransaction;

class Request extends \SmartDto\Dto
{
    public ?int $frequency = 8;
    public ?string $startDate;
    public ?string $stopDate;
    public ?int $specificDayInterval;
    public ?string $currencyCode = "usd";
    public ?int $warehouseID = 3;
    public ?int $shipMethodID = 2;
    public ?int $priceType = 1;
    public ?string $paymentType;
    public ?string $processType;
    public ?string $firstName;
    public ?string $lastName;
    public ?string $company;
    public ?string $address1;
    public ?string $address2;
    public ?string $address3;
    public ?string $city;
    public ?string $zip;
    public ?string $county;
    public ?string $country;
    public ?string $state;
    public ?string $email;
    public ?string $phone;
    public ?string $notes;
    public bool $overwriteExistingAutoOrder;
    public int $existingAutoOrderID;
    public array $details = [];
}