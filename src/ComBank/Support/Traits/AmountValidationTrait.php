<?php

namespace ComBank\Support\Traits;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 2:35 PM
 */

use ComBank\Exceptions\InvalidArgsException;
use ComBank\Exceptions\ZeroAmountException;
use ComBank\Exceptions\InvalidEmailException;
use ComBank\Exceptions\InvalidHolderNameException;

trait AmountValidationTrait
{
    /**
     * @param float $amount
     * @throws InvalidArgsException
     * @throws ZeroAmountException
     */
    public function validateAmount(float $amount): void
    {
        if ($amount <= 0) {
            throw new ZeroAmountException("The amount must be greater than zero.");
        }
    }

  private function validateEmail(string $email): void
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new InvalidEmailException("Invalid email format");
    }
}

private function validateHolderName(string $holderName):void{
    if(strlen(trim($holderName))<3){
        throw new InvalidHolderNameException("Se rechaza la creación de la cuenta porque el nombre del titular no es válido.");
    }
}
}
