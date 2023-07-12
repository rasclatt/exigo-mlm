<?php
namespace Exigo\Services;

use \Exigo\Dto\Customer\ {
    Authenticate\Response as AuthResponse
};

class Auth extends \Exigo\Models\Customer
{
    public static int $defaultCorpId = 3;
    /**
     *	@description	Similar to the customer authentication except it returns the account info as well
     */
    public function validate(
        string $loginName,
        string $password
    ): AuthResponse
    {
        # Fetch id from database
        if(is_numeric($loginName)) {
            $u = $this->getCustomer($loginName);
            $cid = $u->loginName?? null;
        } else {
            $cid = $loginName;
        }
        # Stop if there is no username
        if(!$cid)
            return new AuthResponse([]);
        # Validate the distributor (Requires a database connection)
        $auth = $this->authenticate($cid, $password);
        # Set up array
        $account = null;
        # If valid and set to return account details
        if($auth->customerID) {
            # Fetch the client account details
            $account = $this->getCustomer($auth->customerID);
        }
        # Return all
        return new AuthResponse([
            'customerID' => $auth->customerID,
            'cusomerKey' => $auth->customerKey,
            'account' => $account
        ]);
    }
}