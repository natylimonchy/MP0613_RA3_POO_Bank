<?php namespace ComBank\OverdraftStrategy;

      use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;

/**
 * Created by VS Code.
 * User: JPortugal
 * Date: 7/28/24
 * Time: 12:27 PM
 */

class NoOverdraft implements OverdraftInterface
{

   public function isGrantOverdraftFunds(float $newAmount): bool{
    if($newAmount<0){
        return false;
    }

    return true; 
   }

    public function getOverdraftFundsAmount(): float{
        return 0;

    }

    public function getInterestRate(): int
    {
        return 1;
    }

    public function getWelcomeBonus(): float
    {
        return 10;
    }
}
