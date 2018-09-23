<?php

declare(strict_types=1);

namespace TransitTracker\Infrastructure\Api;

use Prooph\ServiceBus\CommandBus;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use TransitTracker\Application\Command\AddLocationToRoute;
use TransitTracker\Application\Command\ChangeRouteDistance;
use TransitTracker\Application\Command\CreateRoute;
use TransitTracker\Domain\Model\Distance;
use TransitTracker\Domain\Model\Id;
use TransitTracker\Domain\Model\Location;
use TransitTracker\Infrastructure\MapQuest\Resources\Directions\RouteResourceInterface;
use TransitTracker\Infrastructure\ReadModel\Repository\RouteViewRepositoryInterface;
use TransitTracker\Infrastructure\ReadModel\View\LocationView;
use TransitTracker\Infrastructure\ReadModel\View\RouteView;

final class CreateTransitAction
{
    /** @var CommandBus */
    private $commandBus;

    /** @var RouteViewRepositoryInterface */
    private $routeViewRepository;

    /** @var RouteResourceInterface */
    private $routeResource;

    /** @var SerializerInterface */
    private $serializer;

    public function __construct(
        CommandBus $commandBus,
        RouteViewRepositoryInterface $routeViewRepository,
        RouteResourceInterface $routeResource,
        SerializerInterface $serializer
    ) {
        $this->commandBus = $commandBus;
        $this->routeViewRepository = $routeViewRepository;
        $this->routeResource = $routeResource;
        $this->serializer = $serializer;
    }

    public function __invoke(Request $request): Response
    {
        $id = Id::fromUuidInstance(Uuid::uuid4());

        try {
            $content = \json_decode($request->getContent(), true);

            $routeData = \json_decode($this->routeResource->request($content), true);

            $this->commandBus->dispatch(
                CreateRoute::create($id, $request->query->get('name', (string)(new \DateTime())->getTimestamp()))
            );

            foreach ($content['locations'] as $location) {
                $this->commandBus->dispatch(AddLocationToRoute::create($id, new Location($location)));
            }

            $this->commandBus->dispatch(ChangeRouteDistance::create($id, new Distance($routeData['route']['distance'])));
        } catch (\Exception $exception) {
            return JsonResponse::create(['error' => 'Request error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $routeView = $this->routeViewRepository->findOneById($id->value());

        return JsonResponse::create($this->buildResponse($routeView), Response::HTTP_OK);
    }

    private function buildResponse(RouteView $routeView): array
    {
        $locations = [];

        /** @var LocationView $location */
        foreach ($locations as $location) {
            $locations[] = $location->getAddress();
        }

        return [
            'id' => $routeView->getId(),
            'distanceKilometers' => $routeView->getDistance(),
            'locations' => $locations,
            'createdAt' => $routeView->getCreatedAt()->getTimestamp(),
        ];
    }
}
