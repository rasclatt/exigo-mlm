<?php
namespace Exigo\Models;

use \Exigo\Dto\Payment\ {
    Create\Request as CreateRequest,
    Create\Response as CreateResponse,
    GetTypes\Request as GetTypesRequest,
    GetTypes\Response as GetTypesResponse
};

class Payment extends \Exigo\Model
{
    protected string $baseService = '/payment';
    /**
     *	@description	
     *	@param	
     */
    public function create(CreateRequest $request): CreateResponse
    {
        return new CreateResponse($this->toPost("{$this->baseService}/creditcard", $request));
    }
    /**
     *	@description	
     *	@param	
     */
    public function getTypes(GetTypesRequest $request): GetTypesResponse
    {
        return new GetTypesResponse($this->toGet("/account", array_filter($request->toArray())));
    }
}