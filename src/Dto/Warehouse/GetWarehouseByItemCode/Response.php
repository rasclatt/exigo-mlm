<?php
namespace Exigo\Dto\Warehouse\GetWarehouseByItemCode;

class Response extends \SmartDto\Dto
{
    public int $WarehouseID;
    public string $Service;
    public int $DisplayOnWeb;
    public int $ShipCarrierID;
    public int $ShipMethodID;
    public string $Title;
}