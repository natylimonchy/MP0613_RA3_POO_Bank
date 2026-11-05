<?php namespace ComBank\Exceptions;


class InvalidHolderNameException extends BaseExceptions
{
    protected $errorCode = 103;
    protected $errorLabel = 'InvalidHolderNameException';
}
