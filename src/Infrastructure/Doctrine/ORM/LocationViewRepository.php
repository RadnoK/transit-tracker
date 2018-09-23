<?php

declare(strict_types=1);

namespace TransitTracker\Infrastructure\Doctrine\ORM;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use TransitTracker\Infrastructure\ReadModel\Repository\LocationViewRepositoryInterface;
use TransitTracker\Infrastructure\ReadModel\View\LocationView;

final class LocationViewRepository implements LocationViewRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $objectManager;

    /** @var ObjectRepository */
    private $objectRepository;

    public function __construct(EntityManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
        $this->objectRepository = $objectManager->getRepository(LocationView::class);
    }

    public function save(LocationView $locationView): void
    {
        $this->objectManager->persist($locationView);
        $this->objectManager->flush();
    }

    public function findAll(): array
    {
        return $this->objectRepository->findAll();
    }

}
