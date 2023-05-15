<?php
namespace Exigo\Dto\Payment\Create;

class Request extends \SmartDto\Dto
{
    public ?int $orderID = null;
    public ?string $orderKey;
    public ?string $paymentDate = null;
    public ?string $amount = null;
    public ?string $creditCardNumber = null;
    public ?int $expirationMonth = null;
    public ?int $expirationYear = null;
    public ?string $authorizationCode = null;
    public ?string $billingName = null;
    public ?string $billingAddress = null;
    public string $billingAddress2;
    public string $billingCity = null;
    public string $billingZip = null;
    public string $memo;
    public string $merchantTransactionKey;
    /**
     *	@description	
     *	@param	
     */
    protected function beforeConstruct($array)
    {
        if(empty($array['paymentDate']))
            $array['paymentDate'] = date('Y-m-d H:i:s');
        
        return \Exigo\Helpers\ArrayWorks::trimAll($array);
    }
}