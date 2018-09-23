<?php

declare(strict_types=1);

namespace spec\TransitTracker\Domain\Model;

use PhpSpec\ObjectBehavior;
use TransitTracker\Domain\Model\Id;
use TransitTracker\Domain\Model\Location;

final class RouteSpec extends ObjectBehavior
{
    function let(): void
    {
        $this->beConstructedThrough('create', [
            Id::fromString('d0ebe123-96c6-4a41-a3f2-38c37de0a8be'),
        ]);
    }

    function it_has_an_identifier(): void
    {
        $this->id()->shouldBeLike(Id::fromString('d0ebe123-96c6-4a41-a3f2-38c37de0a8be'));
    }

    function it_can_have_locations(): void
    {
        $this->addLocation(new Location('Królewska 1, Poznań, PL'));
    }
}
