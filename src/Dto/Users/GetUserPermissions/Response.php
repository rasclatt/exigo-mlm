<?php
namespace Exigo\Dto\Users\GetUserPermissions;

class Response extends \SmartDto\Dto
{
    public $restrictToCustomerTypes = null;
    public $restrictToCustomerStatuses = null;
    public $restrictToWarehouses = null;
    public $restrictToCountries = null;
    public $restrictToCurrencies = null;
    public ?bool $viewDeletedCustomers = null;
    public ?bool $allowRemoteCheckPrint = null;
    public ?bool $allowOverrideItemPrice = null;
    public ?bool $allowStatementPrint = null;
    public ?int $defaultWarehouseID = null;
    public ?int $languageID = null;
    public ?string $cultureCode = null;
    public $result = null;
}