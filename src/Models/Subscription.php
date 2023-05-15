<?php
namespace Exigo\Models;

use \Exigo\Dto\Subscription\ {
    CreateSubscription\Request as CreateRequest,
    CreateSubscription\Response as CreateResponse,
    GetSubscriptions\Request as GetRequest,
    GetSubscriptions\Response as GetResponse
};

class Subscription extends \Exigo\Model
{
    protected string $baseService = '/autoorder';
    /**
     *	@description	
     *	@param	
     */
    public function createSubscription(CreateRequest $request): CreateResponse
    {
        return new CreateResponse($this->toPost($this->baseService, $request));
    }
    /**
     *	@description	
     *	@param	
     */
    public function getSubscriptions(GetRequest $request): array
    {
        return array_map(fn($v) => new GetResponse($v), $this->toGet($this->baseService, $request->toArray())['autoOrders']?? []);
    }
}