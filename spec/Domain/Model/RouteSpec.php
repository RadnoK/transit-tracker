<?php

declare(strict_types=1);

namespace spec\TransitTracker\Domain\Model;

use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;

final class RouteSpec extends ObjectBehavior
{
    function let(): void
    {
        $this->beConstructedThrough('create', [
            'd0ebe123-96c6-4a41-a3f2-38c37de0a8be',
        ]);
    }

    function it_has_an_identifier(): void
    {
        $this->id()->shouldBeLike(Uuid::fromString('d0ebe123-96c6-4a41-a3f2-38c37de0a8be'));
    }

    function it_has_total_distance(): void
    {
        $this->totalDistance()->shouldReturn(0);
    }
}
