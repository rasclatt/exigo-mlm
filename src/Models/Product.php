<?php
namespace Exigo\Models;

use \Exigo\Dto\Product\ {
    Create\Request as CreateRequest,
    Create\Response as CreateResponse
};

class Product extends \Exigo\Model
{
    protected string $baseService = '/item';
    /**
     *	@description	
     *	@param	
     */
    public function create(CreateRequest $request): CreateResponse
    {
        return new CreateResponse($this->toGet($this->baseService, array_filter($request->toArray())));
    }
    /**
     *	@description	
     *	@param	
     */
    public function getItems(): array
    {
        return $this->toGet($this->baseService, ['currencyCode'=>'usd']);
    }
}