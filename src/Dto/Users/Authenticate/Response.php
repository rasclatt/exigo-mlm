<?php
namespace Exigo\Dto\Users\Authenticate;

class Response extends \SmartDto\Dto
{
    public ?string $firstName = null;
    public ?string $lastName = null;
    public $result = null;
}