<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;

class CreateReviewData
{
    public function __construct(
        #[Assert\Type('string')]
        #[Assert\NotBlank(message: 'Текст отзыва не может быть пустым')]
        #[Assert\Length(min: 10, max: 500)]
        public readonly string $text
    )
    {
    }
}