<?php

namespace App\Common\Exceptions;

use Exception;
use Throwable;

final class GlobalException extends Exception
{
    /**
     * This exception is thrown when a critical error occurs in the application.
     * 
     * @param string $message 
     * @param int $code 
     * @param Throwable|null
     * 
     * @throws GlobalException
     */
    public function __construct(
        string $message = "Global error in the application",
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
