<?php

declare(strict_types=1);

namespace spec\TransitTracker\Infrastructure\ReadModel\View;

use PhpSpec\ObjectBehavior;

final class RouteViewSpec extends ObjectBehavior
{
    function let(): void
    {
        $this->beConstructedWith('536bc9c8-528d-48b3-b079-91684ad6d199', 'Route 66');
    }

    function it_has_an_id(): void
    {
        $this->getId()->shouldReturn('536bc9c8-528d-48b3-b079-91684ad6d199');
    }
}
