<?php
namespace Exigo\Dto\Subscription\GetSubscriptions;

class Request extends \SmartDto\Dto
{
    public ?int $customerID = null;
    public ?int $autoOrderID = null;
}