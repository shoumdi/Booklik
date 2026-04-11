<?php

namespace App\Domain\User\Exceptions;

use DomainException;

use function PHPUnit\Framework\isString;

class EmailAlreadyTakenException extends DomainException
{
    public function __construct(
        private array $messages = [],
    ) {
        if (!count($messages)) parent::__construct('Invalid data given');
        $m  = array_shift($messages);
        if ($count = count($messages)) {
            $m .= "and {{$count}} more " .  ($count === 1) ? 'error' : 'errors';
        }
        parent::__construct($m);
    }
    public function messages()
    {
        return $this->messages;
    }
}
