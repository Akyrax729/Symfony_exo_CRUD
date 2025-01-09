<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Form\PizzaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddController extends AbstractController
{
    #[Route('/add/pizza/{id}', name: 'update_pizza')]
    public function index(Pizza $pizza, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PizzaType::class, $pizza);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($pizza);

            $entityManager->flush();

            $this->addFlash('success', 'Pizza ajouté avec succès !');

            return $this->redirectToRoute('app_home');

        }

        return $this->render('add/update.html.twig', [
            'pizzaform'=>$form->createView(),
            
        ]);
    }
}
