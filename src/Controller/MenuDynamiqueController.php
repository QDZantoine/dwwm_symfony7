<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MenuDynamiqueController extends AbstractController
{
    #[Route('/menu/dynamique', name: 'app_menu_dynamique')]
    public function index(): Response
    {
        return $this->render('menu_dynamique/index.html.twig', [
            'controller_name' => 'MenuDynamiqueController',
        ]);
    }
}
