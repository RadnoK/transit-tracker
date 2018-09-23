<?php

declare(strict_types=1);

namespace spec\TransitTracker\Domain\Model;

use PhpSpec\ObjectBehavior;
use TransitTracker\Domain\Exception\InvalidLocationAddressException;

final class LocationSpec extends ObjectBehavior
{
    function let(): void
    {
        $this->beConstructedWith('Królewska 1, Poznań, PL');
    }

    function it_has_an_address(): void
    {
        $this->address()->shouldReturn('Królewska 1, Poznań, PL');
    }

    function it_throws_an_exception_when_address_value_is_invalid(): void
    {
        $this
            ->shouldThrow(InvalidLocationAddressException::class)
            ->during('__construct', ['Invalid address'])
        ;
    }
}
