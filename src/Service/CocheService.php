<?php

// src/Service/CocheService.php
namespace App\Service;

use App\Entity\Coche;
use App\Repository\CocheRepository;
use Doctrine\ORM\EntityManagerInterface;

class CocheService
{

    public function __construct(private EntityManagerInterface $entityManager, private CocheRepository $cocheRepository)
    {
    }

    public function create(Coche $coche): Coche
    {
        $this->entityManager->persist($coche);
        $this->entityManager->flush();

        return $coche;
    }

    public function eliminarCoche(int $id, $email)
    {
        $coche = $this->entityManager->find("App\Entity\Coche", $id);

        if ($coche != null) {
            if ($coche->getUser()->getEmail() == $email) {
                $this->entityManager->remove($coche);
                $this->entityManager->flush();
            }else{
                throw new \Exception("Ese coche no pertenece al usuario");
            }
        }else{
            throw new \Exception("Ese coche no existe");
        }
    }

    public function list($user)
    {
        return $this->cocheRepository->listar($user);


    }

}