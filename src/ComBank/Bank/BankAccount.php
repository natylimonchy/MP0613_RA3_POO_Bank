<?php namespace ComBank\Bank;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/27/24
 * Time: 7:25 PM
 */

use ComBank\Exceptions\BankAccountException;
use ComBank\Exceptions\InvalidArgsException;
use ComBank\Exceptions\ZeroAmountException;
use ComBank\OverdraftStrategy\NoOverdraft;
use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\FailedTransactionException;
use ComBank\Exceptions\InvalidOverdraftFundsException;
use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;
use ComBank\Support\Traits\AmountValidationTrait;
use ComBank\Transactions\Contracts\BankTransactionInterface;

class BankAccount implements BankAccountInterface
{

    //declarar atributo balance
    private float $balance;
    private bool $status;
    // constructor que reciba balance
    public function  __construct(float $balance ){
        $this->balance = $balance;
        $this->status = true;
        
    }
    // getBalance()
    public function getBalance():float{
        return $this->balance;
    }

    //closeAccount()
    public function closeAccount():void{
        if(!$this->status){
            throw new BankAccountException('The account is already closed');
        }
        $this->status=false;
    }

    public function reopenAccount():void{
         if($this->status){
            throw new BankAccountException('The account is already open');
        }
        $this->status=true;
    }

    public function isOpen(): bool
{
    return $this->status;
}

public function setBalance(float $balance): void
{
    $this->balance = $balance;
}

    public function transaction (BankTransactionInterface $bankTransaction):void{
     if (!$this->isOpen()) {
        throw new BankAccountException('The account is closed.');
    }

    $newBalance = $bankTransaction->applyTransaction($this);
    $this->setBalance($newBalance);
    }
    }
