<?php

declare(strict_types=1);

namespace App\Controller\API\v1;

use App\Request\CreateReviewData;
use App\Service\EpisodeReviewService;
use App\Service\ReviewService;
use App\Service\RickAndMorty\Exception\EpisodeNotFoundException;
use App\Service\RickAndMorty\Exception\RickAndMortyApiException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class EpisodeReviewController extends AbstractController
{
    /**
     * @throws EpisodeNotFoundException
     * @throws RickAndMortyApiException
     */
    #[Route('api/v1/episodes/{episodeId}/reviews', name: 'v1_add_review_episode', methods: ['POST'])]
    public function addReviewToEpisode(
        #[MapRequestPayload] CreateReviewData $data,
        int $episodeId,
        ReviewService $reviewService): JsonResponse
    {
        $review = $reviewService->createReview($episodeId, $data);

        return $this->json($review, Response::HTTP_CREATED);
    }

    /**
     * @throws EpisodeNotFoundException
     * @throws RickAndMortyApiException
     */
    #[Route('/api/v1/episodes/{episodeId}', name: 'v1_show_episode', methods: ['GET'])]
    public function showEpisodeWithReviews(int $episodeId, EpisodeReviewService $service): JsonResponse
    {
        $episode = $service->getEpisodeWithReviews($episodeId);

        return $this->json($episode, Response::HTTP_OK);
    }
}
