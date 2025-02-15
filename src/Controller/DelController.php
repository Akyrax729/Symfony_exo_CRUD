<?php

namespace App\Controller;

use App\Entity\Pizza;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DelController extends AbstractController
{
    #[Route('/del/pizza/{id}', name: 'delete_pizza')]

    public function delete(Pizza $pizza, Request $request, EntityManagerInterface $entityManager): Response
    {
        if($this->isCsrfTokenValid("COUCOU". $pizza->getId(), $request->get('_token'))){
            $entityManager->remove($pizza);
            $entityManager->flush();
            $this->addFlash("success","La suppression a été effectuée");
            return $this->redirectToRoute("app_home");
        }

    }
}
