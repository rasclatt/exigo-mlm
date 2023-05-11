<?php
namespace Exigo\Dto\Product\Create;

class Request extends \SmartDto\Dto
{
    public ?string $currencyCode = null;
    public ?int $priceType = null;
    public ?int $warehouseID = null;
    public ?int $itemCodes = null;
    public ?int $returnLongDetail = null;
    public ?int $restrictToWarehouse = null;
}