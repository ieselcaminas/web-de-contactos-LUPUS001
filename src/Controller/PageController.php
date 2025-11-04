<?php

namespace App\Controller;

//use App\Entity\Borrar;
use App\Entity\Contacto;
//use App\Entity\Provincia;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Este controlador se encarga de las páginas principales como la portada, el home... páginas generales / de navegación
// No crea, edita ni borra nada: simplemente muestra información.
final class PageController extends AbstractController {
    
    #[Route('/', name: 'inicio')] //Mostrará  la portada de la web, mostrará todos los contactos
    public function inicio(ManagerRegistry $doctrine): Response
    {
        // Si no ha iniciado sesión (logeado) le redigirá al login
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        
        //Obtenemos todos los contactos con estas 2 líneas
        $repositorio = $doctrine->getRepository(Contacto::class);
        $contactos = $repositorio->findAll();

        //Renderizamos el template con la lista de contactos
        return $this->render("inicio.html.twig", [
            'contactos' => $contactos,    
        ]);
    }
    
    private $contactos = [
        1 => ["nombre" => "Juan Pérez", "telefono" => "524142432", "email" => "juanp@ieselcaminas.org"],
        2 => ["nombre" => "Ana López", "telefono" => "58958448", "email" => "anita@ieselcaminas.org"],
        5 => ["nombre" => "Mario Montero", "telefono" => "5326824", "email" => "mario.mont@ieselcaminas.org"],
        7 => ["nombre" => "Laura Martínez", "telefono" => "42898966", "email" => "lm2000@ieselcaminas.org"],
        9 => ["nombre" => "Nora Jover", "telefono" => "54565859", "email" => "norajover@ieselcaminas.org"]
    ];    
    

}
