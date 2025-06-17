<?php

declare(strict_types=1);

namespace App\DTO\RickAndMorty;

class EpisodeResult
{
    public function __construct(
        public readonly int    $id,
        public readonly string $episodeName,
        public readonly string $releaseDate,
        public readonly ?float $averageSentimentScore = null
    )
    {
    }
}