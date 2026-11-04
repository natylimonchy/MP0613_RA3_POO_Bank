<?php

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/27/24
 * Time: 7:24 PM
 */

use ComBank\Bank\BankAccount;
use ComBank\OverdraftStrategy\GoldOverfraft;
use ComBank\OverdraftStrategy\SilverOverdraft;
use ComBank\Transactions\DepositTransaction;
use ComBank\Transactions\InterestTransaction;
use ComBank\Transactions\WithdrawTransaction;
use ComBank\Exceptions\BankAccountException;
use ComBank\Exceptions\FailedTransactionException;
use ComBank\Exceptions\InvalidEmailException;
use ComBank\Exceptions\ZeroAmountException;

require_once 'bootstrap.php';


//---[Bank account 1]---/

pl('--------- [Start testing bank account #1, No overdraft] --------');
try {

// create a new account1 with balance 400

    $bankAccount1 = new BankAccount(400.00);


// show balance account

    pl('Showing your current balance account ' . $bankAccount1->getBalance());

// close account

    $bankAccount1->closeAccount();
    pl('Closing your account');

// reopen account

    $bankAccount1->reopenAccount();
    pl('Reopening your account');


// deposit +150 

    pl('Doing transaction deposit (+150) with current balance ' . $bankAccount1->getBalance());
    $bankAccount1->transaction(new DepositTransaction(150.0));

    pl('My new balance after deposit (+150) : ' . $bankAccount1->getBalance());

// withdrawal -25

    pl('Doing transaction withdrawal (-25) with current balance ' . $bankAccount1->getBalance());
    $bankAccount1->transaction(new WithdrawTransaction(25.0));
    pl('My new balance after withdrawal (-25) : ' . $bankAccount1->getBalance());


// withdrawal -600

    pl('Doing transaction withdrawal (-600) with current balance ' . $bankAccount1->getBalance());
    $bankAccount1->transaction(new WithdrawTransaction(600.0));
} catch (ZeroAmountException $e) {
    pl($e->getMessage());
} catch (BankAccountException $e) {
    pl($e->getMessage());
} catch (FailedTransactionException $e) {
    pl('Error transaction: ' . $e->getMessage());
}
pl('My balance after failed last transaction : ' . $bankAccount1->getBalance());




//---[Bank account 2]---/
pl('--------- [Start testing bank account #2, Silver overdraft (100.0 funds)] --------');
$bankAccount2 = new BankAccount(200.00);
$bankAccount2->applyOverdraft(new SilverOverdraft());
try {

    // show balance account
    pl('Showing your current balance account ' . $bankAccount2->getBalance());

    // deposit +100
    pl('Doing transaction deposit (+100) with current balance ' . $bankAccount2->getBalance());
    $bankAccount2->transaction(new DepositTransaction(100.0));


    pl('My new balance after deposit (+100) : ' . $bankAccount2->getBalance());

    // withdrawal -300
    pl('Doing transaction deposit (-300) with current balance ' . $bankAccount2->getBalance());

    $bankAccount2->transaction(new WithdrawTransaction(300.0));

    pl('My new balance after withdrawal (-300) : ' . $bankAccount2->getBalance());

    // withdrawal -50
    pl('Doing transaction deposit (-50) with current balance ' . $bankAccount2->getBalance());
    $bankAccount2->transaction(new WithdrawTransaction(50.0));

    pl('My new balance after withdrawal (-50) with funds : ' . $bankAccount2->getBalance());

    // withdrawal -120
    pl('Doing transaction withdrawal (-120) with current balance ' . $bankAccount2->getBalance());
    $bankAccount2->transaction(new WithdrawTransaction(120.0));
} catch (FailedTransactionException $e) {
    pl('Error transaction: ' . $e->getMessage());
}
pl('My balance after failed last transaction : ' . $bankAccount2->getBalance());

try {
    pl('Doing transaction withdrawal (-20) with current balance : ' . $bankAccount2->getBalance());
    $bankAccount2->transaction(new WithdrawTransaction(20.0));
} catch (FailedTransactionException $e) {
    pl('Error transaction: ' . $e->getMessage());
}
pl('My new balance after withdrawal (-20) with funds : ' . $bankAccount2->getBalance());

try {
    $bankAccount2->closeAccount();
    pl('My account is now closed.');

    $bankAccount2->closeAccount();
} catch (BankAccountException $e) {
    pl('Error: ' . $e->getMessage());
}

//---[Bank account 3]---/
pl('--------- [Start testing bank account #3, Email] --------');
try{
$bankAccount3 = new BankAccount(400.00, "nati@gmail.com");
pl('The email is ' . $bankAccount3->getEmail());


}catch(InvalidEmailException $e){
    pl('Error ' . $e->getMessage());
}

try {
    $bankAccount4 = new BankAccount(400.00, "lalalalala.com");
    pl('The email is ' . $bankAccount4->getEmail());
} catch (InvalidEmailException $e) {
    pl('Error ' . $e->getMessage());
}

//---[ejemplo1]---/
pl('--------- [Ejemplo 1] --------');

$bankAccount4 = new BankAccount(1000.00);
pl("Saldo de la cuenta: " . $bankAccount4->getBalance());
pl("Estrategia de Sobregiro: NoOverdraft");
pl("Tasa de interest: " . $bankAccount4->getOverdraft()->getInterestRate() ."%");
$bankAccount4->transaction(new InterestTransaction());
pl("Saldo despues de la transaccion: " . $bankAccount4->getBalance());

//---[ejemplo2]---/
pl('--------- [Ejemplo 2] --------');

$bankAccount5 = new BankAccount(1000.00);
$bankAccount5->applyOverdraft(new SilverOverdraft());
pl("Saldo de la cuenta: " . $bankAccount5->getBalance());
pl("Estrategia de Sobregiro: SilverOverdraft");
pl("Tasa de interest: " . $bankAccount5->getOverdraft()->getInterestRate() ."%");
$bankAccount5->transaction(new InterestTransaction());
pl("Saldo despues de la transaccion: " . $bankAccount5->getBalance());

//---[ejemplo3]---/
pl('--------- [Ejemplo 3] --------');

$bankAccount6 = new BankAccount(1000.00);
$bankAccount6->applyOverdraft(new GoldOverfraft());
pl("Saldo de la cuenta: " . $bankAccount6->getBalance());
pl("Estrategia de Sobregiro: NoOverdraft");
pl("Tasa de interest: " . $bankAccount6->getOverdraft()->getInterestRate() ."%");
$bankAccount6->transaction(new InterestTransaction());
pl("Saldo despues de la transaccion: " . $bankAccount6->getBalance());

