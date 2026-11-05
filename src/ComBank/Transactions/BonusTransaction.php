<?php namespace ComBank\Transactions;


use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Transactions\Contracts\BankTransactionInterface;
use Override;

class BonusTransaction extends BaseTransaction implements BankTransactionInterface
{
   


	public function __construct()
    {
        $this->amount = 0.0;
    }
public function applyTransaction (BankAccountInterface $account) : float{

$this->amount =  $account->getOverdraft()->getWelcomeBonus() ;
return $account->getBalance() + $this->amount;
}

 public function getAmount(): float
    {
        return $this->amount;
    }

    public function getTransactionInfo(): string
    {
        return 'BONUS_TRANSACTION';
    }

    
   
}