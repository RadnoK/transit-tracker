<?php

declare(strict_types=1);

namespace spec\TransitTracker\Domain\Model;

use PhpSpec\ObjectBehavior;
use TransitTracker\Domain\Exception\InvalidDistanceValueException;

final class DistanceSpec extends ObjectBehavior
{
    function let(): void
    {
        $this->beConstructedWith(100.1);
    }

    function it_has_a_value_in_kilometers(): void
    {
        $this->kilometers()->shouldReturn(100.1);
    }

    function it_throws_an_exception_when_provided_an_invalid_distance_value(): void
    {
        $this
            ->shouldThrow(InvalidDistanceValueException::class)
            ->during('__construct', [-1000])
        ;
    }
}
