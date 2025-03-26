<?php

namespace App\Controller;

use App\Entity\Coche;
use App\Service\CocheService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Throwable;

final class CocheController extends AbstractController
{
    #[Route('/coche', name: 'app_coche')]
    public function index(CocheService $cocheService): Response
    {
        $user = $this->getUser();

        if ($user != null) {
            try {
                $coches = $cocheService->list($user);
            }catch(Throwable $e){
                $this->addFlash("notice", "hubo un error " . $e->getMessage());
                return $this->render("coche/listar.html.twig", [
                    "controller_name" => "CocheController",
                ]);
            }
            return $this->render("coche/listar.html.twig", [
                "controller_name" => "CocheController",
                "coches" => $coches
            ]);


        } else {
            $this->addFlash("userNull", "Tienes que loguearte antes de crear un coche");
            return $this->redirectToRoute("app_login");
        }
    }

    #[Route('/coche/eliminar', name: 'app_coche_eliminar')]
    public function eliminarCoche(Request $request, CocheService $cocheService): Response
    {
        $user = $this->getUser();

        if ($user != null) {
            $id = $request->request->get("id", null);
            try {
                $cocheService->eliminarCoche($id, $user->getUserIdentifier());
            }catch(Throwable $e){
                $this->addFlash("danger", "hubo un error |" . $e->getMessage());
                
            }
            $this->addFlash("success", "Coche ha sido eliminado");
            return $this->redirectToRoute("app_coche"); 

        } else {
            $this->addFlash("userNull", "Tienes que loguearte antes de eliminar un coche");
            return $this->redirectToRoute("app_login");
        }
    }

    #[Route('/coche/crear', name: 'app_coche_crear')]
    public function crearCoche(Request $request, ValidatorInterface $validator, CocheService $cocheService): Response
    {
        $user = $this->getUser();

        if ($user != null) {
            $coche = new Coche();

            if ($request->getMethod() === "POST") {
                try {
                    $marca = $request->request->get("marca", "");
                    $km = $request->request->get("km", 0);
                    $segundaMano = $request->request->get("segundaMano", "");

                    $coche->setMarca($marca);
                    $coche->setKm($km);
                    $coche->setSegundaMano($segundaMano);
                    $coche->setUser($user);

                    $errores = $validator->validate($coche);

                    if (count($errores) > 0) {
                        foreach ($errores as $error) {
                            $this->addFlash("notice", $error->getMessage());
                        }
                        return $this->render("coche/crear.html.twig", ["controller_name" => "CocheController", "coche" => $coche]);
                    } else {
                        $cocheService->create($coche);
                        $this->addFlash("success", "Nota guardada correctamente");
                        return $this->redirectToRoute("app_coche_crear");
                    }
                } catch (Throwable $th) {
                    $this->addFlash("notice", "Hubo un error");
                    return $this->render("coche/crear.html.twig", [
                        "controller_name" => "CocheController",
                    ]);
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
