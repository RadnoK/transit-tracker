<?php

declare(strict_types=1);

namespace Tests\TransitTracker\Behat\Context\Application;

use Behat\Behat\Context\Context;
use Prooph\ServiceBus\CommandBus;
use TransitTracker\Application\Repository\Routes;

final class TransitContext implements Context
{
    /** @var CommandBus */
    private $commandBus;

    /** @var Routes */
    private $routes;

    public function __construct(CommandBus $commandBus, Routes $routes)
    {
        $this->commandBus = $commandBus;
        $this->routes = $routes;
    }

}
