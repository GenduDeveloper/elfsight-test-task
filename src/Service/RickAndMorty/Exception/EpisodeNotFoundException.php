<?php

namespace App\Service\RickAndMorty\Exception;

use Throwable;

class EpisodeNotFoundException extends RickAndMortyApiException
{
    public function __construct(string $message = "Episode not found", int $code = 404, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}