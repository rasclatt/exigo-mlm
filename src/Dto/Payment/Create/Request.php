<?php
namespace Exigo\Dto\Payment\Create;

class Request extends \SmartDto\Dto
{
    public ?int $orderID = null;
    public ?string $paymentDate = null;
    public ?string $amount = null;
    public ?string $creditCardNumber = null;
    public ?int $expirationMonth = null;
    public ?int $expirationYear = null;
    public ?string $billingName = null;
    public ?string $billingAddress = null;
    public ?string $billingAddress2 = null;
    public ?string $billingCity = null;
    public ?string $billingZip = null;
    public ?string $authorizationCode = null;
    public ?string $memo = null;
    public ?string $orderKey = null;
    public ?string $merchantTransactionKey = null;
}