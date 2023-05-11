<?php
namespace Exigo\Models;

use \Exigo\Dto\Customer\ {
    CreateCustomer\Request as CreateCustomerRequest,
    CreateCustomer\Response as CreateCustomerResponse,
    Authenticate\Response as AuthResponse
};

class Customer extends \Exigo\Model
{
    protected string $baseService = '/customers';
    /**
     *	@description	
     */
    public function createCustomer(CreateCustomerRequest $request): CreateCustomerResponse
    {
        return new CreateCustomerResponse($this->toPost("{$this->baseService}/authenticate", $request));
    }
    /**
     *	@description	
     */
    public function authenticate(string $loginName, string $password): AuthResponse
    {
        return new AuthResponse($this->toPost("{$this->baseService}/authenticate", [
            'loginName' => $loginName,
            'password' => $password
        ]));
    }
}