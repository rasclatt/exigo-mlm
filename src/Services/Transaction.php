<?php
namespace Exigo\Services;

class Transaction extends \Exigo\Model
{
    protected string $baseService = '/transaction';
    private array $transactionList = [];
    /**
     *	@description	
     *	@param	
     */
    public function addTransaction(string $type, $body): self
    {
        $this->transactionList[] = [
            'typeName' => $type,
            'request' => $body->toArray()
        ];
        return $this;
    }
    /**
     *	@description	        Executes a transaction
     *	@param	$dto [string]   Will return the response to a SmartDto\Dto object
     *                          ie: ->execute(MyDtoExtendedFromSmartDto::class)
     */
    public function execute(string $dto = null)
    {
        $data = $this->toPost($this->baseService, [
            'transactionRequests' => $this->transactionList
        ]);

        return ($dto && class_exists($dto))? new $dto($data) : $data;
    }
}