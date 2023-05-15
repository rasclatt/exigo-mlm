<?php
namespace Exigo\Dto\Subscription\CreateSubscription;

class Request extends \SmartDto\Dto
{
    public ?int $customerID = null;
    public ?string $frequency = null;
    public ?string $startDate = null;
    public ?string $stopDate = null;
    public ?int $specificDayInterval = null;
    public ?string $currencyCode = null;
    public ?int $warehouseID = null;
    public ?int $shipMethodID = null;
    public ?int $priceType = null;
    public ?string $paymentType = null;
    public ?string $processType = null;
    public ?string $firstName = null;
    public ?string $middleName = null;
    public ?string $lastName = null;
    public ?string $nameSuffix = null;
    public ?string $company = null;
    public ?string $address1 = null;
    public ?string $address2 = null;
    public ?string $address3 = null;
    public ?string $city = null;
    public ?string $state = null;
    public ?string $zip = null;
    public ?string $country = null;
    public ?string $county = null;
    public ?string $email = null;
    public ?string $phone = null;
    public ?string $notes = null;
    public ?string $other11 = null;
    public ?string $other12 = null;
    public ?string $other13 = null;
    public ?string $other14 = null;
    public ?string $other15 = null;
    public ?string $other16 = null;
    public ?string $other17 = null;
    public ?string $other18 = null;
    public ?string $other19 = null;
    public ?string $other20 = null;
    public ?string $description = null;
    public ?bool $overwriteExistingAutoOrder = null;
    public ?int $existingAutoOrderID = null;
    public ?array $detailsOrder = [];
    public ?string $customerKey = null;
    public ?int $customFrequencyTy = null;
    /**
     *	@description	
     *	@param	
     */
    protected function beforeConstruct($array)
    {
        $array['detailsOrder'] = array_map(fn($v) => new DetailsOrder($v), $array['detailsOrder']?? []);
        return $array;
    }
}