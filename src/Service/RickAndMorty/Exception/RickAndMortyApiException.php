<?php

namespace App\Service\RickAndMorty\Exception;

use Throwable;

class RickAndMortyApiException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}