<?php
namespace Exigo\Models;

use \Exigo\Dto\Users\ {
    Authenticate\Response as AuthResponse,
    GetUserPermissions\Response as PermissionsResponse
};

class Users extends \Exigo\Model
{
    protected string $baseService = '/user';
    /**
     *	@description	
     *	@param	
     */
    public function authenticate(string $loginName, string $password): AuthResponse
    {
        return new AuthResponse($this->toPost("{$this->baseService}/authenticate", [
                'loginName' => $loginName,
                'password' => $password
            ])
        );
    }
    /**
     *	@description	
     *	@param	
     */
    public function getUserPermissions(string $loginName): PermissionsResponse
    {
        return new PermissionsResponse($this->toGet("{$this->baseService}/permissions",['loginName' => $loginName ]));
    }
}