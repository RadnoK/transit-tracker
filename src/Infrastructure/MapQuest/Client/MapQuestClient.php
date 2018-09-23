<?php

declare(strict_types=1);

namespace TransitTracker\Infrastructure\MapQuest\Client;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Symfony\Component\HttpFoundation\Request;

final class MapQuestClient implements MapQuestClientInterface
{
    private const BASE_URI = 'http://www.mapquestapi.com';

    /** @var ClientInterface */
    private $client;

    /** @var Response */
    private $response;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function post(string $resourcePath, string $body): void
    {
        $this->response = $this->client->request(
            Request::METHOD_POST,
            $this->getRequestUri($resourcePath),
            [
                'body' => $body,
            ]
        );
    }

    public function responseContent(): string
    {
        return $this->response->getBody()->getContents();
    }

    private function getRequestUri(string $resourcePath): string
    {
        return sprintf('%s%s?key=%s', self::BASE_URI, $resourcePath, getenv('MAPQUEST_KEY'));
    }
}
