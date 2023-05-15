<?php
namespace Exigo\Models;

use \Exigo\Dto\Product\ {
    Create\Request as CreateRequest,
    Create\Response as CreateResponse
};

use \Exigo\Dto\Product\GetItems\Item;

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
    public function getItems(
        string $itemCodes,
        int $priceType = null,
        int $warehouseId = null,
        int $restrictToWarehouse = null,
        string $currencyCode = 'usd',
        bool $returnLongDetail = true
    ): array
    {
        return array_map(
            fn($v) => new Item($v),
            $this->tryCatch(
                fn() => $this->toGet($this->baseService, array_filter([
                    'currencyCode' => $currencyCode,
                    'returnLongDetail' => ($returnLongDetail)? 'true' : null,
                    'priceType'=> $priceType,
                    'warehouseID' => $warehouseId,
                    'itemCodes' => $itemCodes,
                    'restrictToWarehouse' => $restrictToWarehouse
                ])), ['items' => []]
            )['items']
        );
    }
}