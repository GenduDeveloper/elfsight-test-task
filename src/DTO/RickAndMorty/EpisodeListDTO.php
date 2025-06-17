<?php

declare(strict_types=1);

namespace App\DTO\RickAndMorty;

class EpisodeListDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly string $airDate,
        public readonly string $episode
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['air_date'],
            $data['episode']
        );
    }
}