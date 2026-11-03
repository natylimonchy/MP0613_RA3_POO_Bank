<?php namespace ComBank\Exceptions;


class InvalidEmailException extends BaseExceptions
{
    protected $errorCode = 101;
    protected $errorLabel = 'InvalidEmailException';
}
