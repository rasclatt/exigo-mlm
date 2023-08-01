<?php
namespace Exigo\Models;

use \Exigo\Dto\Customer\ {
    CreateCustomer\Request as CreateCustomerRequest,
    CreateCustomer\Response as CreateCustomerResponse,
    Authenticate\Response as AuthResponse,
    GetCustomer\Response as GetCustomerResponse
};

use \Exigo\ {
    Exception as ExigoException
};
use Exigo\Interfaces\Database as IDatabase;

class Customer extends \Exigo\Model
{
    # Set the base service path
    protected string $baseService = '/customers';
    # These are all key name filters that can be set for looking up distributors
    public const CID = 'customerID';
    public const EID = 'enrollerID';
    public const SID = 'sponsorID';
    public const CKEY = 'customerKey';
    public const EKEY = 'enrollerKey';
    public const SKEY = 'sponsorKey';
    protected IDatabase $db;
    /**
     *	@description	Authenticates a distributor and returns basic information along
     *                  with the full account details (if $account TRUE)
     */
    public function authenticate(
        string $loginName,
        string $password
    ): AuthResponse
    {
        # Trim and then see if anything is empty, throw error or return trimmed
        $authCreds = ExigoException::onEmpty([
                'loginName' => $loginName,
                'password' => $password
            ],
            'Invalid username or password',
            403,
            # use a custom function to determine empty
            fn(array $value): array | null => (count(array_filter($value)) !== 2)? null : $value
        );
        # Validate the distributor
        return new AuthResponse($this->toPost("{$this->baseService}/authenticate", $authCreds));
    }
    /**
     *	@description	Fetches a customer based on filter(s)
     */
    public function getCustomer(int $id = null): GetCustomerResponse
    {
        return new GetCustomerResponse($this->getCustomerBy(
            ExigoException::onEmpty($id, 'Invalid Customer Id', 500),
            self::CID
        )[0]?? []);
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
            $this->getCustomerBy(ExigoException::onEmpty($id, 'Invalid Sponsor Id', 500), self::SID)
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
            $this->getCustomerBy(
                ExigoException::onEmpty($id, 'Invalid Enroller Id', 500),
                self::EID
            )
        );
    }
    /**
     *	@description	Fetches a customer based on filter(s)
     */
    public function getCustomerBy(int $value, string $key): array
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
        return new CreateCustomerResponse($this->toPost($this->baseService, $request));
    }

    public function getByUsername(
        string $username
    )
    {
        return $this->db->query(
            "SELECT
                c.*,
                CustomerTypes.CustomerTypeDescription,
                CONCAT(c.FirstName, ' ', c.LastName) as FullName
            FROM
                dbo.Customers as c
            LEFT JOIN
                dbo.CustomerTypes ON c.CustomerTypeID = CustomerTypes.CustomerTypeID
            WHERE
                c.LoginName = ?", [$username])
            ->getResults(1);
    }
    /**
     * @description Fetch the customer id when passing in their LoginName
     */
    public function getIdFromUsername(string $username):? int
    {
        $id = $this->db->query(
            "SELECT
                CustomerID as id
            FROM
                dbo.Customers
            WHERE
                LoginName = ?", [$username])
            ->getResults(1)['id']?? null;
        return is_numeric($id)? (int) $id : null;
    }
    /**
     * @description Fetch the customer type name from customer type id
     */
    public function getCustomerType(int $customerTypeID):? string
    {
        return $this->db->query(
            "SELECT
                CustomerTypeDescription
            FROM
                dbo.CustomerTypes
            WHERE
                CustomerTypeID = ?", [$customerTypeID])
            ->getResults(1)['CustomerTypeDescription']?? null;
    }
    /**
     * @description Fetch the customer type name from customer type id
     */
    public function getCustomerStatus(int $statusID):? string
    {
        return $this->db->query(
            "SELECT
                CustomerStatusDescription
            FROM
                dbo.CustomerStatuses
            WHERE
                CustomerStatusID = ?", [$statusID])
            ->getResults(1)['CustomerStatusDescription']?? null;
    }
    /**
     * @description Fetch the name of the price type
     */
    public function getCustomerPriceType(int $PriceTypeID):? string
    {
        return $this->db->query(
            "SELECT
                PriceTypeDescription as n
            FROM
                dbo.PriceTypes
            WHERE
                PriceTypeID = ?", [$PriceTypeID])
            ->getResults(1)['n']?? null;
    }
    /**
     * @description Fetch the name of the price type
     */
    public function getCustomerPriceTypeId(string $PriceTypeDescription):? int
    {
        return $this->db->query(
            "SELECT
                PriceTypeID as n
            FROM
                dbo.PriceTypes
            WHERE
                PriceTypeDescription = ?", [$PriceTypeDescription])
            ->getResults(1)['n']?? null;
    }
    /**
     * @description Quick check to see if the user is able to log in
     */
    public function canLogIn(
        string $searchBy,
        string $key = 'LoginName'
    ): bool
    {
        return $this->db->query(
            "SELECT
                COUNT(*) as count
            FROM
                dbo.Customers
            WHERE
                {$key} = ?
                    AND
                CanLogin = 1", [ $searchBy ]
            )
            ->getResults(1)['count'] > 0;
    }
    /**
     * @description Checks if a webalias is already being usein
     **/
    public function loginNameExists(string $username): bool
    {
        return $this->db->query(
            "SELECT COUNT(*) as count FROM Customers WHERE LoginName = ?",
            [ $username ]
        )->getResults(1)['count'] > 0;
    }
    /**
     * @description Checks if a webalias is already being usein
     **/
    public function distIdExists(int $distid, string $column = 'CustomerID'): bool
    {
        return $this->db->query(
            "SELECT COUNT(*) as count FROM Customers WHERE {$column} = ?",
            [ $distid ]
        )->getResults(1)['count'] > 0;
    }
    /**
     * @description Fetches the CustomerID based on their webalias
     **/
    public function getCustomerIdFromWebAlias(string $uname):? int
    {
        return $this->db->query(
            "SELECT CustomerID as cid FROM CustomerSites WHERE WebAlias = ?",
            [ $uname ]
        )->getResults(1)['cid']?? null;
    }
    /**
     * @description 
     **/
    public function getCustomerByCustomerID(int $customerID)
    {
        $id = $this->db->query("SELECT LoginName FROM Customers WHERE CustomerID = ?", [$customerID])->getResults(1)['LoginName']?? null;

        if(!$id) {
            return [];
        }

        return $this->getByUsername($id);
    }
    /**
     * @description Fetches the users customer id name from their login name
     **/
    public function getCustomerIdFromLoginName(string $username):? string
    {
        return $this->db->query(
            "SELECT CustomerID FROM Customers WHERE LoginName = ?",
            [ $username ]
        )->getResults(1)['CustomerID']?? null;
    }
}