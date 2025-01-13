<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordEncoder): Response
    {
        $user = new User();

        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            $user->setRoles(['ROLE_USER']);
            $user->setPassword(
            $passwordEncoder->hashPassword($user,$form->get('password')->getData())
            )
            ;
            
            $entityManager->persist($user);

            $entityManager->flush();

            $this->addFlash('success', 'user ajouté avec succès !');

            return $this->redirectToRoute('app_home');

        }

        

        return $this->render('register/register.html.twig', [
            'registerform'=>$form->createView(),

        ]);
    }
}