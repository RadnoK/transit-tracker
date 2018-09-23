<?php

declare(strict_types=1);

namespace Tests\TransitTracker\Behat\Context\Infrastructure;

use Behat\Behat\Context\Context;
use Symfony\Component\BrowserKit\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\TransitTracker\Asserter\AsserterInterface;

final class TransitContext implements Context
{
    /** @var Client */
    private $client;

    /** @var AsserterInterface */
    private $asserter;

    public function __construct(Client $client, AsserterInterface $asserter)
    {
        $this->client = $client;
        $this->asserter = $asserter;
    }

    /**
     * @When I browse all transits
     */
    public function iBrowseAllTransits(): void
    {
        $this->client->request(Request::METHOD_GET, '/transits');
    }

    /**
     * @Then I should see all available transits
     */
    public function iShouldSeeAllAvailableTransits(): void
    {
        /** @var Response $response */
        $response = $this->client->getResponse();

        $this->asserter->assertResponse(
            $response,
            Response::HTTP_OK,
            file_get_contents(__DIR__.'/../../../Responses/Expected/transit/index_response.json')
        );
    }
}
