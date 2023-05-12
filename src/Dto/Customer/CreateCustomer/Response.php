<?php
namespace Exigo\Dto\Customer\CreateCustomer;

class Response extends \SmartDto\Dto
{
    public ?int $customerID = null;
    public ?string $customerKey = null;
    public $result = null;
}