<?php namespace ComBank\OverdraftStrategy;

      use ComBank\OverdraftStrategy\Contracts\OverdraftInterface;
use Override;

class GoldOverfraft implements OverdraftInterface
{

   public function isGrantOverdraftFunds(float $newAmount): bool{
    if($newAmount + $this->getOverdraftFundsAmount()<0){
        return false;
    }

    return true; 
   }

    public function getOverdraftFundsAmount(): float{
        return 500;

    }

    public function getInterestRate(): int
    {
        return 10;
    }


    public function getWelcomeBonus(): float
    {
        return 50;
    }
}