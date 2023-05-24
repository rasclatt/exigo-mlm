<?php
namespace Exigo\Dto\Customer\Authenticate;

use \Exigo\Dto\Customer\GetCustomer\Response as GetCustomerResponse;

use \Exigo\Dto\Users\ {
    Authenticate\Response as AuthResponse
};

class Response extends AuthResponse
{
    public ?int $customerID = null;
    public ?string $customerKey = null;
    public GetCustomerResponse $account;
}