<?php

namespace App\Exceptions\customExceptions;
use Exception;
abstract class BaseException extends Exception
{

    public function __construct($message=""){
     parent::__construct($this->getMessageException($message),$this->getCodeException());
    }
    protected abstract function getMessageException($message);
    protected abstract function getCodeException();
}
