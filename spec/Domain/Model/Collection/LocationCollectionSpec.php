<?php

declare(strict_types=1);

namespace spec\TransitTracker\Domain\Model\Collection;

use PhpSpec\ObjectBehavior;
use TransitTracker\Domain\Exception\LocationAlreadyExistsException;
use TransitTracker\Domain\Exception\LocationNotFoundException;
use TransitTracker\Domain\Model\Location;

final class LocationCollectionSpec extends ObjectBehavior
{
    function let(): void
    {
        $this->beConstructedThrough('createEmpty');
    }

    function it_can_be_created_empty(): void
    {
        $this->count()->shouldReturn(0);
    }

    function it_can_be_created_from_an_array(): void
    {
        $this->beConstructedThrough('fromArray', [[
            new Location('Królewska 1, Poznań, PL'),
            new Location('Legnicka 1, Wrocław, PL'),
        ]]);

        $this->exists('Królewska 1, Poznań, PL')->shouldReturn(true);
        $this->exists('Legnicka 1, Wrocław, PL')->shouldReturn(true);
        $this->count()->shouldReturn(2);
    }

    function it_can_add_a_product(): void
    {
        $this->add(new Location('Królewska 1, Poznań, PL'));

        $this->exists('123-456-1')->shouldReturn(true);

        $this->count()->shouldReturn(1);
    }

    function it_can_remove_a_product(): void
    {
        $this->add(new Location('Królewska 1, Poznań, PL'));

        $this->remove('Królewska 1, Poznań, PL');

        $this->exists('Królewska 1, Poznań, PL')->shouldReturn(false);
        $this->count()->shouldReturn(0);
    }

    function it_can_be_converted_to_array(): void
    {
        $this->add(new Location('Królewska 1, Poznań, PL'));

        $this->toArray()->shouldBeLike(['123-456-1' => new Location('Królewska 1, Poznań, PL')]);
    }

    function it_throws_an_exception_when_a_product_already_exists(): void
    {
        $this->add(new Location('Królewska 1, Poznań, PL'));
        $this
            ->shouldThrow(LocationAlreadyExistsException::class)
            ->during('add', [new Location('Królewska 1, Poznań, PL')])
        ;
    }

    function it_throws_an_exception_when_a_product_is_not_found(): void
    {
        $this
            ->shouldThrow(LocationNotFoundException::class)
            ->during('get', ['Fischerinsel 1, Berlin, DE'])
        ;
    }
}
