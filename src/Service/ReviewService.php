<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Review;
use App\Request\CreateReviewData;
use App\Service\RickAndMorty\Exception\EpisodeNotFoundException;
use App\Service\RickAndMorty\Exception\RickAndMortyApiException;
use App\Service\RickAndMorty\RickAndMortyService;
use Doctrine\ORM\EntityManagerInterface;

class ReviewService
{
    public function __construct(
        private readonly RickAndMortyService $rickAndMortyService,
        private readonly SentimentAnalyzerService $sentimentAnalyzerService,
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    /**
     * @throws EpisodeNotFoundException
     * @throws RickAndMortyApiException
     */
    public function createReview(int $episodeId, CreateReviewData $data): Review
    {
        $episode = $this->rickAndMortyService->getEpisodeById($episodeId);
        $sentimentScore = $this->sentimentAnalyzerService->getResultSentimentText($data->text);

        $newReview = new Review();
        $newReview->setContent(mb_strtolower($data->text));
        $newReview->setSentimentScore($sentimentScore);
        $newReview->setCreatedAt(new \DateTimeImmutable());
        $newReview->setEpisodeId($episode->id);

        $this->entityManager->persist($newReview);
        $this->entityManager->flush();

        return $newReview;
    }
}