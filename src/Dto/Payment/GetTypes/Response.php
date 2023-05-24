<?php
namespace Exigo\Dto\Payment\GetTypes;

class Response extends \SmartDto\Dto
{
    public ?CreditCardAccountResponse $primaryCreditCard = null;
    public ?CreditCardAccountResponse $secondaryCreditCard = null;
    public ?BankAccountResponse $bankAccount = null;
    public ?WalletAccountResponse $primaryWalletAccount = null;
    public ?WalletAccountResponse $secondaryWallletAccount = null;
    public ?WalletAccountResponse $thirdWalletAccount = null;
    public ?WalletAccountResponse $fourthWalletAccount = null;
    public ?WalletAccountResponse $fifthWalletAccount = null;
    /**
     *	@description	
     *	@param	
     */
    protected function beforeConstruct($array)
    {
        $array['primaryCreditCard'] = (!empty($array['primaryCreditCard']))? new CreditCardAccountResponse($array['primaryCreditCard']) : null;
        $array['secondaryCreditCard'] = (!empty($array['primaryCreditCard']))? new CreditCardAccountResponse($array['secondaryCreditCard']) : null;
        $array['bankAccount'] = (!empty($array['primaryCreditCard']))? new BankAccountResponse($array['bankAccount']) : null;
        $array['primaryWalletAccount'] = (!empty($array['primaryCreditCard']))? new WalletAccountResponse($array['primaryWalletAccount']) : null;
        $array['secondaryWallletAccount'] = (!empty($array['primaryCreditCard']))? new WalletAccountResponse($array['secondaryWallletAccount']) : null;
        $array['thirdWalletAccount'] = (!empty($array['primaryCreditCard']))? new WalletAccountResponse($array['thirdWalletAccount']) : null;
        $array['fourthWalletAccount'] = (!empty($array['primaryCreditCard']))? new WalletAccountResponse($array['fourthWalletAccount']) : null;
        $array['fifthWalletAccount'] = (!empty($array['primaryCreditCard']))? new WalletAccountResponse($array['fifthWalletAccount']) : null;
        return $array;
    }
}