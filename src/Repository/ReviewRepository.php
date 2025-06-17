<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Review>
 */
class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

    public function getAverageSentimentScoreByEpisodeId(int $episodeId): float|null
    {
        $queryBuilder = $this->createQueryBuilder('r')
            ->select('AVG(r.sentimentScore)')
            ->where('r.episodeId = :episodeId')
            ->setParameter('episodeId', $episodeId);

        return (float)$queryBuilder->getQuery()->getSingleScalarResult();
    }
}
