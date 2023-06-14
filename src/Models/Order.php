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
    /**
     * @description Fetches previous addresses used in orders
     **/
    public function getAddresses(int $customerID): array
    {
        return array_map(
            fn($v) => new \Exigo\Dto\Order\GetAddresses\Response($v),
            $this->db
                ->query("SELECT DISTINCT Address1, Address2, City, State, Zip FROM Orders WHERE CustomerID = ?", [ $customerID ])
                ->getResults()
        );
    }
    /**
     * @description 
     **/
    public function getOrderStatuses(): array
    {
        $data = $this->db->query("SELECT * FROM OrderStatuses")->getResults();
        foreach($data as $row) {
            $new[$row['OrderStatusID']] = $row['OrderStatusDescription'];
        }
        return $new;
    }
}