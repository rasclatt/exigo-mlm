<?php
namespace Exigo\Models;

use \Exigo\Dto\Order\ {
    CalculateOrder\Request as CalcOrderRequest,
    CalculateOrder\Response as CalcOrderResponse,
    CreateOrder\Request as CreateOrderRequest,
    CreateOrder\Response as CreateOrderResponse
};

class Order extends \Exigo\Model
{
    protected string $baseService = '/orders';
    /**
     *	@description	
     *	@param	
     */
    public function calculateOrder(CalcOrderRequest $request): CalcOrderResponse
    {
        return new CalcOrderResponse($this->toPost("{$this->baseService}/calculate", $request));
    }
    /**
     *	@description	
     *	@param	
     */
    public function createOrder(CreateOrderRequest $request): CreateOrderResponse
    {
        return new CreateOrderResponse($this->toPost($this->baseService, $request));
    }
}