<?php

namespace App\Exceptions\customExceptions;

use App\constunts\StatuseCode;
use App\Exceptions\Handler;
use App\constunts\StatusCode;

class sourceNotFoundException extends Handler
{

    public function getMessageException($message)
    {

        return $message?: 'resource not found ';

    }
    public function getCodeException()
    {
        return StatuseCode::NOT_FOUND;
    }

}
