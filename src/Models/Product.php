<?php
namespace Exigo\Models;

use \Exigo\Dto\Product\ {
    Create\Request as CreateRequest,
    Create\Response as CreateResponse
};

use \Exigo\Dto\Product\GetItems\Item;
use \Exigo\Helpers\ArrayWorks;
use Exigo\Helpers\StringWorks;

class Product extends \Exigo\Model
{
    protected string $baseService = '/item';
    protected array $colList = [
        'i.ItemID',
        'i.ItemCode',
        'i.ItemTypeID',
        'i.ItemStatus',
        'i.LargeImageName as Image',
        'i.ItemDescription as Title',
        'i.LongDetail as PackContents',
        'i.LongDetail2 as NutritionalFactsAndUsage',
        'i.LongDetail3 as ProductBenefits',
        'i.LongDetail4 as AdditionalBenefits',
        'i.ShortDetail as ShortDescription',
        'i.ShortDetail2 as ShortDescription2',
        'i.ShortDetail3 as ShortDescription3',
        'i.ShortDetail4 as ShortDescription4',
        'i.Notes',
        'i.Weight',
        'i.IsVirtual',
        'i.IsGroupMaster',
        'i.SuppressGroupMaster',
        'i.GroupDescription',
        'i.GroupMembersDescription',
        'i.AllowOnAutoOrder',
        'i.HideFromSearch',
        'i.AvailableAllCountryRegions',
        'i.TinyImageName',
        'i.SmallImageName',
        'i.Field1',
        'i.Field2',
        'i.Field3',
        'i.Field4',
        'i.Field5',
        'i.Field6',
        'i.Field7',
        'i.Field8',
        'i.Field9',
        'i.Field10',
        'i.OtherCheck1',
        'i.OtherCheck2',
        'i.OtherCheck3',
        'i.OtherCheck4',
        'i.OtherCheck5',
        'i.Auto1',
        'i.Auto2',
        'i.Auto3',
        'i.ModifiedDate',
        'i.CalculateTaxOnKitDetail',
        'i.CalculateShipOnKitDetail',
        'i.EntryDate',
        'i.AvailableInAllWarehouses',
        'i.TaxedInAllCountryRegions',
        'i.IsSubscriptionUpdate',
        'i.IsPointIncrement'
    ];
    /**
     *	@description	
     *	@param	
     */
    public function create(CreateRequest $request): CreateResponse
    {
        return new CreateResponse($this->toGet($this->baseService, array_filter($request->toArray())));
    }
    /**
     *	@description    Fetches items from the API but itemcodes and warehouse ids are required
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
    /**
     * @description Fetch products from the web categories set up
     * @requires    Requires a connection to the reporting database
     */
    public function getProductsByWebCategory(
        string $category,
        string $priceType,
        string $currencyCode = 'usd',
        array $children = null
    ): array
    {
        $def = [];
        # Get all the categories under the first parent category
        $data = $this->db->query("WITH WebCategoryHierarchy AS (
            SELECT * FROM WebCategories
            WHERE WebCategoryDescription = ?
            UNION ALL
            SELECT t.* FROM WebCategories t
            JOIN WebCategoryHierarchy wh ON t.ParentID = wh.WebCategoryID
          )
          SELECT * FROM WebCategoryHierarchy", [$category])->getResults();
        # IF nothing matches the category, just stop
        if(empty($data))
            return $def;
        # Build a web category array to cherry pick
        $data = ArrayWorks::buildNestedArray($data);
        # Just stop if nothing
        if(empty($data))
            return $def;
        # Use a base array to extract ids from
        $children = array_merge([$category], (!empty($children)? $children : []));
        $categoryIds = $def;
        # Extract all the categories from all child categories
        ArrayWorks::findChildCategoryIds($data, $children, $categoryIds);
        # Stop if there are none
        if(empty($categoryIds))
            return $def;
        # Fetch all the products from found categories
        $data = $this->db->query(
            "SELECT
                ".implode(',',$this->colList).",
                ipr.*
            FROM Items i
            LEFT JOIN WebCategoryItems wci ON i.ItemID = wci.ItemID
            LEFT JOIN ItemPrices ipr ON i.ItemID = ipr.ItemID
                AND ipr.CurrencyCode = ?
                AND ipr.PriceTypeID = (
                    SELECT PriceTypeID FROM PriceTypes WHERE PriceTypeDescription = ?
                )
            WHERE wci.WebCategoryID IN (".implode(',', array_fill(0, count($categoryIds), '?')).")
            ORDER BY wci.SortOrder ASC
            ",
            array_merge([$currencyCode, $priceType], $categoryIds))
        ->getResults();
        if(empty($data))
            return $data;
        foreach($data as $k => $row) {
            $this->additions($data[$k], $row['ItemCode'], $currencyCode);
        }
        return $data;
    }
    /**
     * @description 
     **/
    public function getProduct(
        string $itemCode,
        string | int $priceType,
        string $currencyCode = 'usd'
    )
    {
        $bind = [
            $currencyCode,
            $priceType,
            $itemCode
        ];
        if(is_numeric($priceType)) {
            $sql = '?';
        } else {
            $sql = "(
                SELECT PriceTypeID FROM PriceTypes WHERE PriceTypeDescription = ?
            )";
        }
        # Fetch current product
        $product = $this->db->query(
            "SELECT
                ".implode(',',$this->colList).",
                ipr.*
            FROM Items i
            LEFT JOIN ItemPrices ipr ON i.ItemID = ipr.ItemID
                AND ipr.CurrencyCode = ?
                AND ipr.PriceTypeID = {$sql}
            WHERE
                i.ItemCode = ?",
                $bind
            )
        ->getResults(1);
        # Fetch all product prices for comparison
        $this->additions($product, $itemCode, $currencyCode);
        return $product;
    }
    /**
     * @description 
     **/
    public function getItemCodesByDescription(
        string $type,
        string $column = 'ShortDetail3'
    )
    {
        $items = [];
        foreach($this->db->query("SELECT ItemCode FROM Items WHERE {$column} LIKE ?", ["%{$type}%"])->getResults() as $item) {
            $items[] = $this->getProduct($item['ItemCode'], 1);
        }
        return $items;
    }
    /**
     * @description 
     **/
    public function getItemMembers(string $ItemCode)
    {
        return $this->db->query(
            "SELECT ".implode(',', $this->colList)."
            FROM Items i
            JOIN ItemGroupMembers igm ON i.ItemID = igm.ItemID
            JOIN ItemGroupMembers igmt ON igmt.MasterItemID = igm.MasterItemID
            WHERE igmt.ItemID = (SELECT ItemID FROM Items ib WHERE ib.ItemCode = ?)
            ORDER BY igmt.Priority ASC", [ $ItemCode ]
        )->getResults();
    }
    /**
     * @description 
     **/
    private function additions(&$product, $itemCode, $currencyCode)
    {
        # Fetch all product prices for comparison
        $p = $this->db->query(
            "SELECT ip.Price, ip.PriceTypeID, pt.PriceTypeDescription as PriceType FROM ItemPrices ip
            LEFT JOIN Items i ON i.ItemID = ip.ItemID
                AND ip.CurrencyCode = ?
                AND ip.PriceTypeID IN (SELECT PriceTypeID FROM PriceTypes)
            LEFT JOIN PriceTypes pt ON ip.PriceTypeID = pt.PriceTypeID
            WHERE
                i.ItemCode = ?",
        [$currencyCode, $itemCode])->getResults();
        foreach($p as $row) {
            $product['PricesAll'][StringWorks::wordToAbbrev($row['PriceType'])] = $row;
        }
        $product['Options'] = $this->getItemMembers($itemCode);
        if(!is_array($product['Options']))
        $product['Options'] = [];
    }
    /**
     * @description 
     **/
    public function getProductColumnsBySku(string $ItemCode, array | string $columnName)
    {
        if(!is_array($columnName))
            $columnName = [$columnName];
        return $this->db->query("SELECT ".implode(",", $columnName)." FROM Items WHERE ItemCode = ?", [$ItemCode])->getResults(count($columnName));
    }
}