<?php namespace ComBank\Exceptions;

class AccountBlockedException extends BaseExceptions
{
    protected $errorCode = 104;
    protected $errorLabel = 'AccountBlockedException';
}
