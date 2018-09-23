<?php

declare(strict_types=1);

namespace spec\TransitTracker\Application\Command;

use PhpSpec\ObjectBehavior;
use TransitTracker\Domain\Model\Id;

final class CreateRouteSpec extends ObjectBehavior
{
    function it_represents_an_immutable_intention_of_creating_a_route(): void
    {
        $routeId = Id::fromString('6ef57170-d62f-403b-bef4-53db78be2460');

        $this->beConstructedThrough('create', [$routeId]);

        $this->id()->shouldBeLike(Id::fromString('6ef57170-d62f-403b-bef4-53db78be2460'));
    }
}
