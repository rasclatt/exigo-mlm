<?php
namespace Exigo\Models;

use \Exigo\Dto\Payment\Create\ {
    Request as CreateRequest,
    Response as CreateResponse
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
}