<?php
namespace Exigo\Models;

class Transaction extends \Exigo\Model
{
    private array $transactionRequests = [];
    protected string $service = 'transaction';
    /**
     * @description 
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
     * @description 
     **/
    public function remove(string $actionName): self
    {
        if(isset($this->transactionRequests[$actionName]))
            unset($this->transactionRequests[$actionName]);

        return $this;
    }
    /**
     * @description 
     **/
    public function send()
    {
        return $this->toPost($this->service, [
            'transactionRequests' => array_values($this->transactionRequests)
        ]);
    }
}