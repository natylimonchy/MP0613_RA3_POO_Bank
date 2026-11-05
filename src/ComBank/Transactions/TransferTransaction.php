<?php namespace ComBank\Transactions;

use ComBank\Bank\Contracts\BankAccountInterface;
use ComBank\Transactions\Contracts\BankTransactionInterface;
use ComBank\Exceptions\InvalidOverdraftFundsException;

class TransferTransaction extends BaseTransaction implements BankTransactionInterface
{
    private BankAccountInterface $destination;

    public function __construct(float $amount, BankAccountInterface $destination)
    {
        parent::__construct($amount);       
        $this->destination = $destination;   
    }

    public function applyTransaction(BankAccountInterface $account): float
    {
        
        $newBalance = $account->getBalance() - $this->amount;
        if ($account->getOverdraft()->isGrantOverdraftFunds($newBalance) === false) {
            throw new InvalidOverdraftFundsException("Insufficient funds.");
        }

        
        $this->destination->transaction(new DepositTransaction($this->amount));

        
        return $newBalance;
    }

    public function getTransactionInfo(): string
    {
        return 'TRANSFER_TRANSACTION';
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getDestination(): BankAccountInterface
    {
        return $this->destination;
    }
}