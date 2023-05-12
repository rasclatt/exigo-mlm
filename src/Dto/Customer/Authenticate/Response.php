<?php
namespace Exigo\Dto\Customer\Authenticate;


use \Exigo\Dto\Users\ {
    Authenticate\Response as AuthResponse
};

class Response extends AuthResponse
{
    public ?int $customerID = null;
    public ?string $customerKey = null;
}