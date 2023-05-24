<?php
namespace Exigo\Dto;

class Request extends \SmartDto\Dto
{
    public ?int $customerID = null;
    public ?string $customerKey = null;
}