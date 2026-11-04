<?php namespace ComBank\Transactions;



use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Transactions\Contracts\BankTransactionInterface;
use Override;

class InterestTransaction extends BaseTransaction implements BankTransactionInterface
{


	public function __construct()
    {
       $this->amount = 0.0;
    }
public function applyTransaction (BankAccountInterface $account) : float{


$this->amount = ($account->getBalance()*$account->getOverdraft()->getInterestRate())/100;
return $account->getBalance() + $this->amount;


}

 public function getAmount(): float
    {
        return $this->amount;
    }

    public function getTransactionInfo(): string
    {
        return 'INTEREST_TRANSACTION';
    }

    
   
}
