<?php

declare(strict_types=1);

namespace App\Service\RickAndMorty;

use App\DTO\RickAndMorty\EpisodeListDTO;
use App\DTO\RickAndMorty\EpisodeListResult;
use App\DTO\RickAndMorty\EpisodePaginationDTO;
use App\DTO\RickAndMorty\EpisodeResult;
use App\Service\RickAndMorty\Exception\EpisodeNotFoundException;
use App\Service\RickAndMorty\Exception\RickAndMortyApiException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RickAndMortyService
{
    public function __construct(
        private readonly HttpClientInterface $rickAndMortyClient
    ) {
    }

    /**
     * @throws RickAndMortyApiException
     */
    public function getEpisodesWithPagination(int $page = null): EpisodeListResult
    {
        try {
            $response = $this->rickAndMortyClient->request('GET', 'episode', [
                'query' => ['page' => $page]
            ]);
            $data = $response->toArray();
        } catch (\Throwable $ex) {
            throw new RickAndMortyApiException('An error has occurred: ' . $ex->getMessage(), $ex->getCode(), $ex);
        }

        $paginationData = EpisodePaginationDTO::fromArray($data['info']);
        $episodesData   = [];

        foreach ($data['results'] as $episode) {
            $episodesData[] = EpisodeListDTO::fromArray($episode);
        }

        return new EpisodeListResult(pagination: $paginationData, data: $episodesData);
    }

    /**
     * @throws RickAndMortyApiException
     * @throws EpisodeNotFoundException
     */
    public function getEpisodeById(int $episodeId): EpisodeResult
    {
        try {
            $response = $this->rickAndMortyClient->request('GET', "episode/{$episodeId}");

            if ($response->getStatusCode() === Response::HTTP_NOT_FOUND) {
                throw new EpisodeNotFoundException();
            }

            $data = $response->toArray();

            return new EpisodeResult($data['id'], $data['name'], $data['air_date']);

        } catch (\Throwable $ex) {
            throw new RickAndMortyApiException('An error has occurred: ' . $ex->getMessage(), $ex->getCode(), $ex);
        }
    }
}