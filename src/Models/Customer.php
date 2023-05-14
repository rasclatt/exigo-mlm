<?php
namespace Exigo\Models;

use \Exigo\Dto\Customer\ {
    CreateCustomer\Request as CreateCustomerRequest,
    CreateCustomer\Response as CreateCustomerResponse,
    Authenticate\Response as AuthResponse,
    GetCustomer\Response as GetCustomerResponse
};

class Customer extends \Exigo\Model
{
    # These are all key name filters that can be set for looking up distributors
    public const CID = 'customerID';
    public const EID = 'enrollerID';
    public const SID = 'sponsorID';
    public const CKEY = 'customerKey';
    public const EKEY = 'enrollerKey';
    public const SKEY = 'sponsorKey';

    protected string $baseService = '/customers';
    /**
     *	@description	Authenticates a distributor and returns basic information along
     *                  with the full account details (if $account TRUE)
     */
    public function authenticate(
        string $loginName,
        string $password,
        bool $account = true
    ): AuthResponse
    {
        # Validate the distributor
        $auth = new AuthResponse($this->toPost("{$this->baseService}/authenticate", [
            'loginName' => $loginName,
            'password' => $password
        ]));
        # If valid and set to return account details
        if($auth->customerID && $account) {
            # Fetch the client account details
            $auth->account = $this->getCustomer($auth->customerID);
        }
        return $auth;
    }
    /**
     *	@description	Fetches a customer based on filter(s)
     */
    public function getCustomer(int $id = null): GetCustomerResponse
    {
        return new GetCustomerResponse($this->getCustomerBy($id, self::CID)['customers'][0]?? []);
    }
    /**
     *	@description	Fetches all distributors based on their sponsor id
     */
    public function getSponsored(
        int $id = null
    ): array
    {
        return array_map(
            fn($v) => new GetCustomerResponse($v),
            $this->getCustomerBy($id, self::SID)
        );
    }
    /**
     *	@description	Fetches all distributors based on their enroller id
     */
    public function getEnrolled(
        int $id = null
    ): array
    {
        return array_map(
            fn($v) => new GetCustomerResponse($v),
            $this->getCustomerBy($id, self::EID)
        );
    }
    /**
     *	@description	Fetches a customer based on filter(s)
     */
    public function getCustomerBy(
        int $value = null,
        string $key = null
    ): array
    {
        return array_map(
            fn($v) => new GetCustomerResponse($v),
            $this->toGet($this->baseService, [ $key => $value ])['customers']
        );
    }
    /**
     *	@description	Obvious
     */
    public function createCustomer(CreateCustomerRequest $request): CreateCustomerResponse
    {
        return new CreateCustomerResponse($this->toPost("{$this->baseService}/authenticate", $request));
    }
}