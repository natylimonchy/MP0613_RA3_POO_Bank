<?php namespace ComBank\Bank\Contracts;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/27/24
 * Time: 7:26 PM
 */

use ComBank\Exceptions\BankAccountException;
use ComBank\Exceptions\FailedTransactionException;
use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;
use ComBank\Transactions\Contracts\BankTransactionInterface;

interface BankAccountInterface
{
    const STATUS_OPEN = 'OPEN';
    const STATUS_CLOSED = 'CLOSED';

    public function transaction(BankTransactionInterface $bankTransaction): void;

    public function isOpen(): bool;

    public function reopenAccount(): void;

    public function closeAccount(): void;

    public function getBalance(): float;

    public function getOverdraft(): OverdraftInterface;

    public function applyOverdraft(OverdraftInterface $overdraft): void;

    public function setBalance(float $balance): void;

    public function setEmail (string $email): void;

    public function getEmail () : string;

    public function isBlocked() : bool;

    public function unblockAccount () :void;

    public function blockAccount () : void;



   
}
