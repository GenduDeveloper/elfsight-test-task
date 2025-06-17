<?php

declare(strict_types=1);

namespace App\DTO\Review;

class ReviewListDTO
{
    public function __construct(
        public readonly string $reviewText,
        public readonly \DateTimeInterface $createdAt
    )
    {
    }
}