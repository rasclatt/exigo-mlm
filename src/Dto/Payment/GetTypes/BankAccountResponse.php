<?php
namespace Exigo\Dto\Payment\GetTypes;

class BankAccountResponse extends \Exigo\Dto\Payment\Billing
{
    public ?string $bankAccountNumberDisplay = null;
    public ?string $bankRoutingNumber = null;
    public ?string $bankName = null;
    public ?string $bankAccountType = null;
    public ?string $nameOnAccount = null;
    public ?string $checkIban = null;
    public ?string $checkSwiftCode = null;
}