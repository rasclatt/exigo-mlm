<?php
namespace Exigo\Helpers;

class Auth
{
    public static function toApiKey(string $company, string $loginName, string $password): string
    {
        return base64_encode("{$loginName}@{$company}:{$password}");
    }
}