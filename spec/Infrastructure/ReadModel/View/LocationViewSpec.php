<?php

declare(strict_types=1);

namespace spec\TransitTracker\Infrastructure\ReadModel\View;

use PhpSpec\ObjectBehavior;
use TransitTracker\Infrastructure\ReadModel\View\RouteView;

final class LocationViewSpec extends ObjectBehavior
{
    function let(RouteView $routeView): void
    {
        $this->beConstructedWith($routeView, 'Królewska 1, Poznań, PL');
    }

    function it_has_a_route(RouteView $routeView): void
    {
        $this->getRoute()->shouldBeLike($routeView);
    }

    function it_has_an_address(): void
    {
        $this->getAddress()->shouldReturn('Królewska 1, Poznań, PL');
    }
}
