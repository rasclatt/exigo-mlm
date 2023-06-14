<?php
namespace Exigo\Models;

class Transaction extends \Exigo\Model
{
    private array $transactionRequests = [];
    protected string $service = 'transaction';
    /**
     * @description Add to the transaction array
     **/
    public function add(string $actionName, array $data): self
    {
        $this->transactionRequests[$actionName] = [
            'typeName' => $actionName,
            'request' => $data
        ];
        return $this;
    }
    /**
     * @description Removes a transaction object from the transaction array
     **/
    public function remove(string $actionName): self
    {
        if(isset($this->transactionRequests[$actionName]))
            unset($this->transactionRequests[$actionName]);

        return $this;
    }
    /**
     * @description Send the transaction via post
     **/
    public function send()
    {
        return $this->toPost($this->service, [
            'transactionRequests' => $this->getTransactionData()
        ]);
    }
    /**
     * @description Returns the transaction data for review
     **/
    public function getTransactionData(): array
    {
        return array_values($this->transactionRequests);
    }
}