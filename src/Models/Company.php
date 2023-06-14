<?php
namespace Exigo\Models;

use \Exigo\Dto\Company\GetRegions\Response as RegionsResponse;

class Company extends \Exigo\Model
{
    /**
     *  @description	Returns countries set up in the system
     */
    public function getRegions(string $region = null): RegionsResponse
    {
        return new RegionsResponse(empty($region)? [] : $this->toGet('/country/regions', $region? [ 'countryCode' => $region ] : null));
    }
    /**
     * @description 
     **/
    public function getCountries():array
    {
        return $this->db->query("SELECT CountryCode as code, CountryDescription as name FROM Countries ORDER BY Priority ASC")->getResults();
    }
}