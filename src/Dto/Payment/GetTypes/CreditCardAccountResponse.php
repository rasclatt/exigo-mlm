<?php
namespace Exigo\Dto\Payment\GetTypes;

class CreditCardAccountResponse extends \Exigo\Dto\Payment\Billing
{
    public ?string $creditCardNumberDisplay = null;
    public ?string $creditCardToken = null;
    public ?int $expirationMonth = null;
    public ?int $expirationYear = null;
    public ?int $creditCardType = null;
    public ?string $creditCardTypeDescription = null;
}