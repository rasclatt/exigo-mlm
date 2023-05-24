<?php
namespace Exigo\Dto\Payment;

class Billing extends \SmartDto\Dto
{
    public string $billingAddress;
    public string $billingCity;
    public string $billingState;
    public string $billingZip;
    public string $billingCountry;
    public ?string $billingAddress2 = null;
}