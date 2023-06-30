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
    public function getCountries(array $countries = null): array
    {
        $sql = (!empty($countries))? " WHERE CountryCode IN (".implode(',', array_fill(0, count($countries), '?')).")" : "";
        $bind = (!empty($countries))? $countries : null;
        return $this->db->query("SELECT CountryCode as code, CountryDescription as name FROM Countries {$sql} ORDER BY Priority ASC", $bind)->getResults();
    }
}