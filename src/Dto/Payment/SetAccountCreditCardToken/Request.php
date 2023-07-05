<?php
namespace Exigo\Dto\Payment\SetAccountCreditCardToken;

class Request extends \Exigo\Dto\Request
{
    public string $creditCardToken;
    public int $expirationMonth;
    public int $expirationYear;
    public bool $useMainAddress;
    public int $creditCardAccountType;
    public int $creditCardType;
    public string $billingCountry;
    public string $billingState;
}