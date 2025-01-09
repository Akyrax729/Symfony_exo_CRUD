<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DelController extends AbstractController
{
    #[Route('/del', name: 'app_del')]
    public function index(): Response
    {
        return $this->render('del/index.html.twig', [
            'controller_name' => 'DelController',
        ]);
    }
}
