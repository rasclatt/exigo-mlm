<?php
namespace Exigo\Dto\Subscription\GetSubscriptions;

class Response extends \SmartDto\Dto
{
    public ?int $customerID = null;
    public ?int $autoOrderID = null;
    public ?string $autoOrderStatus = null;
    public ?string $frequency = null;
    public ?string $startDate = null;
    public ?string $stopDate = null;
    public ?string $lastRunDate = null;
    public ?string $nextRunDate = null;
    public ?string $currencyCode = null;
    public ?int $warehouseID = null;
    public ?int $shipMethodID = null;
    public ?string $paymentType = null;
    public ?string $processType = null;
    public ?string $firstName = null;
    public ?string $lastName = null;
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
    public ?float $total = null;
    public ?float $subTotal = null;
    public ?float $taxTotal = null;
    public ?float $shippingTotal = null;
    public ?float $discountTotal = null;
    public ?float $businessVolumeTotal = null;
    public ?float $commissionableVolumeTotal = null;
    public ?string $description = null;
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
    public ?array $detailsAutoOrder = [];
    public ?string $modifiedDate = null;
    public ?string $modifiedBy = null;
    public ?string $middleName = null;
    public ?string $nameSuffix = null;
    public ?int $specificDayInterval = null;
    public ?string $createdDate = null;
    public ?string $createdBy = null;
    public ?string $customerKey = null;
    public ?int $customFrequencyTy = null;
    /**
     *	@description	
     *	@param	
     */
    protected function beforeConstruct($array)
    {
        $array['detailsAutoOrder'] = array_map(fn($v) => new AutoOrderDetails($v), $array['detailsAutoOrder']?? []);
        return $array;
    }
}