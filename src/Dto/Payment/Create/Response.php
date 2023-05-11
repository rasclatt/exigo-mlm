<?php
namespace Exigo\Dto\Payment\Create;

class Response extends \Exigo\Dto\Response
{
    public ?int $paymentID = null;
    public ?string $message = null;
    public ?string $displayMessage = null;
    public ?string $merchantTransactionKey = null;
}