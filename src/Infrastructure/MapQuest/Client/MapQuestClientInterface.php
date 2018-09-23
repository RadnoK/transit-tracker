<?php

declare(strict_types=1);

namespace TransitTracker\Infrastructure\MapQuest\Client;

interface MapQuestClientInterface
{
    public function post(string $resourcePath, string $body): void;

    public function responseContent(): string;
}
