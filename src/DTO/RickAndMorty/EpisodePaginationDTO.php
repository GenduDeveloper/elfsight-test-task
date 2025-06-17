<?php

declare(strict_types=1);

namespace App\DTO\RickAndMorty;

class EpisodePaginationDTO
{
    public function __construct(
        public readonly int $count,
        public readonly int $pages,
        public readonly ?string $next,
        public readonly ?string $prev
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['count'],
            $data['pages'],
            $data['next'],
            $data['prev']
        );
    }
}