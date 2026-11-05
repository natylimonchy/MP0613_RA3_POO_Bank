<?php

namespace ComBank\Transactions;

use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Exceptions\BankAccountException;
use ComBank\Transactions\Contracts\BankTransactionInterface;
use ComBank\Exceptions\InvalidOverdraftFundsException;
use Override;

class TransferTransaction extends BaseTransaction implements BankTransactionInterface
{

    private BankAccountInterface $destinationAccount;


public function __construct(float $amount, BankAccountInterface $destinationAccount)
    {
        parent::__construct($amount);
        $this->destinationAccount = $destinationAccount;
    }


    public function applyTransaction(BankAccountInterface $account): float
    {

        if($account->getBalance()<$this->amount){
            throw new BankAccountException("Transferencia rechazada cuando la cuenta de origen no tiene fondos suficientes.");  
        }
        $this->destinationAccount->transaction((new DepositTransaction($this->amount)));
        $monto = $account->getBalance()-$this->amount;
        $account->setBalance($monto);

        
        
        return $account->getBalance();

    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getTransactionInfo(): string
    {
        return 'TRANSFER_TRANSACTION';
    }


    public function setDestinationAccount(BankAccountInterface $destination)
    {
        $this->destinationAccount = $destination;
    }

    public function getDestinationAccount(): BankAccountInterface
    {

        return $this->destinationAccount;
    }
}
