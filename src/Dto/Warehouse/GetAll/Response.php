<?php
namespace Exigo\Dto\Warehouse\GetAll;

class Response extends \SmartDto\Dto
{
    public ?int $warehouseID = null;
    public ?string $description = null;
    public ?string $address1 = null;
    public ?string $address2 = null;
    public ?string $city = null;
    public ?string $state = null;
    public ?string $zip = null;
    public ?string $country = null;
}