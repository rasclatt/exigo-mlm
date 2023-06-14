<?php
namespace Exigo\Dto\Order\GetAddresses;

class Response extends \SmartDto\Dto
{
    public string $Address1;
    public string $Address2 = '';
    public string $City;
    public string $State;
    public string $Zip;
}