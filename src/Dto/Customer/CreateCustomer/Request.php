<?php
namespace Exigo\Dto\Customer\CreateCustomer;

class Request extends \SmartDto\Dto
{
    public ?int $customerType = null;
    public ?int $customerStatus = null;
    public ?int $binaryPlacementPreference = null;
    public ?string $firstName = null;
    public ?string $lastName = null;
    public ?string $company = null;
    public ?string $email = null;
    public ?string $phone = null;
    public ?string $mainAddress1 = null;
    public ?string $mainCity = null;
    public ?string $mainState = null;
    public ?string $mainZip = null;
    public ?string $mailState = null;
    public ?string $mailCountry = null;
    public ?string $otherState = null;
    public ?string $otherCountry = null;
    public ?string $taxIDType = null;
    public ?string $middleName = null;
    public ?string $nameSuffix = null;
    public ?string $payableTy = null;
    public ?bool $useBinaryHoldingTank = null;
    public ?bool $mainAddressVerified = null;
    public ?bool $mailAddressVerified = null;
    public ?bool $otherAddressVerified = null;
}