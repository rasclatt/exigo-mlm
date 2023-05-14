<?php
namespace Exigo\Models;

use \Exigo\Dto\Warehouse\GetAll\Response as GetAllResponse;

class Warehouse extends \Exigo\Model
{
    protected string $baseService = '/warehouse';
    /**
     *	@description	
     *	@param	
     */
    public function getAll(): array
    {
        return array_map(fn($v) => new GetAllResponse($v), $this->toGet($this->baseService)['warehouses']);
    }
}