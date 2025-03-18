<?php

namespace App\Controller;

use Symfony\Bridge\Doctrine\Security\User\EntityUserProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CocheController extends AbstractController
{
    #[Route('/coche', name: 'app_coche')]
    public function index(): Response
    {
        return $this->render('coche/index.html.twig', [
            'controller_name' => 'CocheController',
        ]);
    }

    #[Route('/coche/crear', name: 'app_coche_crear')]
    public function crearCoche(): Response
    {
        $user = $this->getUser();

        if($user != null){

        }else{
            $this->addFlash("userNull", "Tienes que loguearte antes de crear un coche");
            return $this->redirectToRoute("app_login");
        }

        return $this->render('coche/crear.html.twig', [
            'controller_name' => 'CocheController',
        ]);
    }
}
