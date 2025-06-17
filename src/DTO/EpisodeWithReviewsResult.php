<?php

declare(strict_types=1);

namespace App\DTO;

use App\DTO\Review\ReviewListDTO;
use App\DTO\RickAndMorty\EpisodeResult;

class EpisodeWithReviewsResult
{
    public function __construct(
        public readonly EpisodeResult $data,
        /**
         * @var ReviewListDTO[]
         */
        public array $reviews
    )
    {
    }
}