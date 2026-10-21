<?php namespace ComBank\Transactions;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 1:22 PM
 */

use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\InvalidOverdraftFundsException;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class WithdrawTransaction extends BaseTransaction implements BankTransactionInterface
{

public function applyTransaction(BankAccountInterface $account): float
    {
        $newBalance = $account->getBalance() - $this->amount;
        if($account->getOverdraft()->isGrantOverdraftFunds($newBalance)===false){
        throw new InvalidOverdraftFundsException("Insufficient funds for withdrawal and overdraft is not allowed.");    
        }
        
        return $newBalance;
    }

    public function getTransactionInfo(): string
    {
        return 'WITHDRAW_TRANSACTION';
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
   
}
