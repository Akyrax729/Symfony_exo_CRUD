<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Form\PizzaType;
use App\Repository\PizzaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]

    public function index(Request $request, EntityManagerInterface $entityManager, PizzaRepository $repository): Response
    {

        // FORM

        $pizza = new Pizza();

        $form = $this->createForm(PizzaType::class, $pizza);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($pizza);

            $entityManager->flush();

            $this->addFlash('success', 'Pizza ajouté avec succès !');

            return $this->redirectToRoute('app_home');

        }

        // VIEW 

        $pizzas = $repository->findAll();

        // RETURN 
        
        return $this->render('home/index.html.twig', [
            'pizzaform'=>$form->createView(),
            'pizzas'=>$pizzas,
        ]); 
    }

}
