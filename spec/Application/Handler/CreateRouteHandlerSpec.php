<?php

declare(strict_types=1);

namespace spec\TransitTracker\Application\Handler;

use PhpSpec\ObjectBehavior;
use Prooph\ServiceBus\EventBus;
use Prophecy\Argument;
use TransitTracker\Application\Command\CreateRoute;
use TransitTracker\Application\Event\RouteCreated;
use TransitTracker\Application\Repository\Routes;
use TransitTracker\Domain\Model\Id;
use TransitTracker\Domain\Model\Route;

final class CreateRouteHandlerSpec extends ObjectBehavior
{
    function let(Routes $routes, EventBus $eventBus): void
    {
        $this->beConstructedWith($routes, $eventBus);
    }

    function it_creates_route(Routes $routes, EventBus $eventBus): void
    {
        $id = Id::fromString('d2c75772-c84c-4959-b6f9-4658d0aff6cd');

        $routes
            ->add(Argument::exact(Route::create($id)))
            ->shouldBeCalled()
        ;

        $eventBus
            ->dispatch(Argument::that(function (RouteCreated $event) use ($id): bool {
                return $event->id() == $id;
            }))
            ->shouldBeCalled()
        ;

        $this(CreateRoute::create($id));
    }
}
