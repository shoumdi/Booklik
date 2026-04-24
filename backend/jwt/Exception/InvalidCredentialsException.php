<?php

namespace JWT\Exception;

use Exception;
use Throwable;

class InvalidCredentialsException extends Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable|null $previous = null)
    {

        return parent::__construct($message, $code, $previous);
    }
    public function errors()
    {
        return ['email' => 'Invalid credentials', 'password' => 'Invalid credentials'];
    }
}
