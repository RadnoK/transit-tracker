<?php

declare(strict_types=1);

namespace Tests\TransitTracker\Asserter;

use Symfony\Component\HttpFoundation\Response;

interface AsserterInterface
{
    /**
     * @throws \InvalidArgumentException
     */
    public function assertResponse(Response $response, int $code, string $expectedContent): void;

    /**
     * @throws \InvalidArgumentException
     */
    public function assertResponseContent(Response $response, string $expectedContent): void;

    /**
     * @throws \InvalidArgumentException
     */
    public function assertResponseCode(Response $response, int $code): void;

    /**
     * @throws \InvalidArgumentException
     */
    public function assertResponseHeader(Response $response): void;
}
