<?php

declare(strict_types=1);

namespace App\Controller\API\v1;

use App\Service\RickAndMorty\Exception\RickAndMortyApiException;
use App\Service\RickAndMorty\RickAndMortyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RickAndMortyEpisodeController extends AbstractController
{
    /**
     * @throws RickAndMortyApiException
     */
    #[Route(path: '/api/v1/episodes', name: 'v1_episodes', methods: ['GET'])]
    public function episodes(Request $request, RickAndMortyService $service): JsonResponse
    {
        $page = $request->query->getInt('page', 1);
        $episodes = $service->getEpisodesWithPagination($page);

        return $this->json($episodes, Response::HTTP_OK);
    }
}