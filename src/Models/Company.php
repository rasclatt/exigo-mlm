<?php
namespace Exigo\Models;

use \Exigo\Dto\Company\GetRegions\Response as RegionsResponse;

class Company extends \Exigo\Model
{
    /**
     *	@description	Returns countries set up in the system
     */
    public function getRegions(string $region): RegionsResponse
    {
        return new RegionsResponse(empty($region)? [] : $this->toGet('/country/regions', [ 'countryCode' => $region ]));
    }
}