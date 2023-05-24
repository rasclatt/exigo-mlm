<?php
namespace Exigo\Dto\Payment\GetTypes;

class WalletAccountResponse extends \SmartDto\Dto
{
    public ?int $walletType = null;
    public ?string $walletAccountDisplay = null;
    public ?string $walletOther1 = null;
    public ?string $walletOther2 = null;
    public ?string $walletOther3 = null;
}