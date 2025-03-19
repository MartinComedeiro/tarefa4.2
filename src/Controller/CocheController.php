<?php

namespace App\Controller;

use App\Entity\Coche;
use App\Service\CocheService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
    public function crearCoche(Request $request, ValidatorInterface $validator, CocheService $cocheService): Response
    {
        $user = $this->getUser();

        if ($user != null) {
            $coche = new Coche();

            if ($request->getMethod() === "POST") {
                $marca = $request->request->get("marca", "");
                $km = $request->request->get("km", null);
                $segundaMano = $request->request->get("segundaMano", "");

                $coche->setMarca($marca);
                $coche->setKm($km);
                $coche->setSegundaMano($segundaMano);
                $coche->setUser($user);

                $errores = $validator->validate($coche);

                if (count($errores) > 0) {
                    foreach ($errores as $error) {
                        $this->addFlash("warning", $error->getMessage());
                    }
                    return $this->render("coche/crear.html.twig", ["coche" => $coche]);
                } else {
                    $cocheService->create($coche);
                    $this->addFlash("success", "Nota guardada correctamente");
                    return $this->redirectToRoute("app_coche_crear");
                }

            } else {
                return $this->render("coche/crear.html.twig", [
                    "controller_name" => "CocheController",
                    "coche" => $coche
                ]);
            }

        } else {
            $this->addFlash("userNull", "Tienes que loguearte antes de crear un coche");
            return $this->redirectToRoute("app_login");
        }
    }
}
