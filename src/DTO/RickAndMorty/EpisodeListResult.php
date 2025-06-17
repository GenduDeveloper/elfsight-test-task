<?php

declare(strict_types=1);

namespace App\DTO\RickAndMorty;

class EpisodeListResult
{
    /**
     * @param EpisodePaginationDTO $pagination
     * @param EpisodeListDTO[] $data
     */
    public function __construct(public readonly EpisodePaginationDTO $pagination, public readonly array $data)
    {
    }
}