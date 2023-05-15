<?php
namespace Exigo\Dto\Sms\Send;

class Request extends \SmartDto\Dto
{
    public int $customerID;
    public string $message;
    public string $phone;
    public string $customerKey;
}