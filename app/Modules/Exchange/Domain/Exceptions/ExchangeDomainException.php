<?php

namespace App\Modules\Exchange\Domain\Exceptions;

use Exception;

class ExchangeDomainException extends Exception
{
    public function __construct(
        string $message = "Exchange domain error", 
        int $code = 0, 
        ?Exception $previous = null

    ) {
        parent::__construct($message, $code, $previous);
    }
}
