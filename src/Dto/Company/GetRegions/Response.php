<?php
namespace Exigo\Dto\Company\GetRegions;

class Response extends \SmartDto\Dto
{
    public ?string $selectedCountry = null;
    public array $countries = [];
    public array $regions = [];
    /**
     *	@description	
     *	@param	
     */
    protected function beforeConstruct($array)
    {
        $array['countries'] = array_map(fn($v) => new Countries($v), $array['countries']?? []);
        $array['regions'] = array_map(fn($v) => new Regions($v), $array['regions']?? []);
        return $array;
    }
}