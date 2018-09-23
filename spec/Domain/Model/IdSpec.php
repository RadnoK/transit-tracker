<?php

declare(strict_types=1);

namespace spec\TransitTracker\Domain\Model;

use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\UuidInterface;

final class IdSpec extends ObjectBehavior
{
    function it_can_be_created_from_string(): void
    {
        $this->beConstructedThrough('fromString', ['bb0519a2-d752-45e1-9e61-ffcca343a35f']);

        $this->__toString()->shouldReturn('bb0519a2-d752-45e1-9e61-ffcca343a35f');
    }

    function it_can_be_created_from_uuid_instance(UuidInterface $id): void
    {
        $id->toString()->willReturn('07f7fe61-2c03-43b0-a566-7841a1536ca6');

        $this->beConstructedThrough('fromUuidInstance', [$id]);

        $this->__toString()->shouldReturn('07f7fe61-2c03-43b0-a566-7841a1536ca6');
    }
}
