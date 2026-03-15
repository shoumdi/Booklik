<?php

namespace JWT;

use DomainException;
use Exception;

trait JsonHandler
{

    /**
     * @throws DomainExceptio/s in case of error
     * 
     * convert an array associative into json object
     * 
     */
    public function jsonEncode(array $data): string
    {
        $json = json_encode($data, JSON_UNESCAPED_SLASHES);
        if (json_last_error())
            throw new DomainException(json_last_error_msg());
        if (!$json) throw new DomainException('couldn\'t encode the provided object into json');
        return $json;
    }
    public function jsonDecode(string $data):mixed{
        return json_decode($data);
    }
}
