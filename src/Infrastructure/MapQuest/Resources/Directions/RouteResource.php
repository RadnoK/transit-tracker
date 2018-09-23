<?php

declare(strict_types=1);

namespace TransitTracker\Infrastructure\MapQuest\Resources\Directions;

use TransitTracker\Infrastructure\MapQuest\Client\MapQuestClientInterface;

final class RouteResource implements RouteResourceInterface
{
    public const RESOURCE_PATH = '/directions/v2/route';

    /** @var MapQuestClientInterface */
    private $apiClient;

    public function __construct(MapQuestClientInterface $client)
    {
        $this->apiClient = $client;
    }

    public function request(array $locations): string
    {
        $this->apiClient->post(self::RESOURCE_PATH, json_encode($locations));

        return $this->apiClient->responseContent();
    }
}
