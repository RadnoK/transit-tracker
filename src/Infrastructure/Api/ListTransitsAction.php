<?php

declare(strict_types=1);

namespace TransitTracker\Infrastructure\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TransitTracker\Infrastructure\ReadModel\Repository\RouteViewRepositoryInterface;
use TransitTracker\Infrastructure\ReadModel\View\LocationView;
use TransitTracker\Infrastructure\ReadModel\View\RouteView;

final class ListTransitsAction
{
    /** @var RouteViewRepositoryInterface */
    private $routeViewRepository;

    public function __construct(RouteViewRepositoryInterface $routeViewRepository)
    {
        $this->routeViewRepository = $routeViewRepository;
    }

    public function __invoke(Request $request): Response
    {
        $routeViews = $this->routeViewRepository->findAll();

        if (0 === count($routeViews)) {
            return JsonResponse::create(['transits' => []], Response::HTTP_NOT_FOUND);
        }

        return JsonResponse::create(['transits' => $this->buildResponse($routeViews)], Response::HTTP_OK);
    }

    private function buildResponse(array $routeViews): array
    {
        $response = [];

        /** @var RouteView $routeView */
        foreach ($routeViews as $routeView) {
            $locations = [];

            /** @var LocationView $location */
            foreach ($routeView->getLocations() as $location) {
                $locations[] = $location->getAddress();
            }

            $response[] = [
                'id' => $routeView->getId(),
                'distanceKilometers' => $routeView->getDistance(),
                'locations' => $locations,
                'createdAt' => $routeView->getCreatedAt()->getTimestamp(),
            ];
        }

        return $response;
    }
}
