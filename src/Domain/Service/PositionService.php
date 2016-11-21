<?php

namespace Felipecwb\Catho\Domain\Service;

use Felipecwb\Catho\Domain\Entity\Position;
use Felipecwb\Catho\Domain\Repository\PositionRepository;

class PositionService
{
    private $repository;

    public function __construct(PositionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findAll(array $filter = array(), $salaryOrder = null)
    {
        $positions = $this->repository->find($filter);

        if ($salaryOrder === 'asc') {
            usort($positions, function (Position $a, Position $b) {
                return ($a->getSalary() > $b->getSalary()) - ($a->getSalary() < $b->getSalary());
            });
        }

        if ($salaryOrder === 'desc') {
            usort($positions, function (Position $a, Position $b) {
                return ($a->getSalary() < $b->getSalary()) - ($a->getSalary() > $b->getSalary());
            });
        }

        return $positions;
    }

    public function getAvailableLocations()
    {
        return $this->repository->findLocations();
    }
}
