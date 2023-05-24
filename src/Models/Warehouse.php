<?php
namespace Exigo\Models;

use \Exigo\Dto\Warehouse\ {
    GetAll\Response as GetAllResponse,
    GetWarehouseByItemCode\Response as WarehouseByICResponse
};

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
    /**
     * @description Fetches all the warehouses being used by an itemcode in a certain country
     **/
    public function getWarehousesByItemCode(string $itemCode, string $country = 'US'): array
    {
        return array_map(fn($v) => new WarehouseByICResponse($v), $this->db->query(
            "SELECT
                w.WarehouseID,
                w.WarehouseDescription AS Service,
                s.DisplayOnWeb,
                s.ShipCarrierID,
                s.ShipMethodID,
                s.ShipMethodDescription AS Title
            FROM
                Warehouses w
            INNER JOIN
                ItemWarehouses iw ON iw.WarehouseID = w.WarehouseID
            INNER JOIN
                ShipMethods s ON w.WarehouseID = s.WarehouseID
            INNER JOIN
                Items i ON i.ItemID = iw.ItemID
            WHERE
                s.DisplayOnWeb = 1
                AND w.WarehouseCountry = ?
                AND i.ItemCode = ?",
            [
                $country,
                $itemCode
            ])
            ->getResults());
    }
}