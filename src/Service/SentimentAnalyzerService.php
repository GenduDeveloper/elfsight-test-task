<?php

declare(strict_types=1);

namespace App\Service;

use Sentiment\Analyzer;

class SentimentAnalyzerService
{
    public function getResultSentimentText(string $text): float
    {
        $analyzer = new Analyzer();
        $result = $analyzer->getSentiment($text);

        $sentimentScoreResult = ($result['compound'] + 1) / 2;

        return round($sentimentScoreResult, 2);
    }
}