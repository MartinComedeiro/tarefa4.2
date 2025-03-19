<?php

// src/Service/CocheService.php
namespace App\Service;

use App\Entity\Coche;
use App\Repository\CocheRepository;
use Doctrine\ORM\EntityManagerInterface;

class CocheService
{

    public function __construct(private EntityManagerInterface $entityManager, private CocheRepository $cocheRepository) {
    }

    public function create(Coche $coche): Coche
    {
        $this->entityManager->persist($coche);
        $this->entityManager->flush();

        return $coche;
    }

}