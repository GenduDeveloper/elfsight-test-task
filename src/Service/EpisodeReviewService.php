<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\EpisodeWithReviewsResult;
use App\DTO\Review\ReviewListDTO;
use App\DTO\RickAndMorty\EpisodeResult;
use App\Repository\ReviewRepository;
use App\Service\RickAndMorty\Exception\EpisodeNotFoundException;
use App\Service\RickAndMorty\Exception\RickAndMortyApiException;
use App\Service\RickAndMorty\RickAndMortyService;

class EpisodeReviewService
{
    private const REVIEWS_PER_PAGE_LIMIT = 3;

    public function __construct(
        private readonly RickAndMortyService $rickAndMortyService,
        private readonly ReviewRepository    $reviewRepository
    ) {
    }

    /**
     * @throws EpisodeNotFoundException
     * @throws RickAndMortyApiException
     */
    public function getEpisodeWithReviews(int $episodeId): EpisodeWithReviewsResult
    {
        $episode = $this->rickAndMortyService->getEpisodeById($episodeId);

        $reviews = $this->reviewRepository->findBy(
            criteria: ['episodeId' => $episode->id],
            orderBy: ['createdAt' => 'DESC'],
            limit: self::REVIEWS_PER_PAGE_LIMIT
        );

        $averageSentimentScore = $this->reviewRepository->getAverageSentimentScoreByEpisodeId($episodeId);

        $episodeData = new EpisodeResult(
            $episode->id,
            $episode->episodeName,
            $episode->releaseDate,
            $averageSentimentScore);

        $reviewsData = [];

        foreach ($reviews as $review) {
            $reviewsData[] = new ReviewListDTO($review->getContent(), $review->getCreatedAt());
        }

        return new EpisodeWithReviewsResult(data: $episodeData, reviews: $reviewsData);
    }
}