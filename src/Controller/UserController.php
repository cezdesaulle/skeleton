<?php

namespace App\Controller;

use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    /**
     * @Route("/allusers", name="allusers")
     */
    public function allUsers( UserRepository $userRepository )
    {
        $users = $userRepository->findAll();

        return $this->render('user/allusers.html.twig', [
            'users' => $users,
        ]);
    }



    /**
     * @Route("/updateUser_{id}", name="updateUser")
     */
    public function updateUser($id, Request $request, EntityManagerInterface $manager)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($user);
            $manager->flush();

            return $this->render('user/index.html.twig', [
                'controller_name' => 'UserController',
            ]);
        }
    }

    /**
    *@Route("/deleteUser{id}",name="deleteUser")
    */
    public function deleteUser($id, EntityManagerInterface  $manager, UserRepository  $userRepository)
    {
        $user = $userRepository->find($id);
        $manager->remove($user);
        $manager->flush();

        return $this->redirectToRoute('allusers');
    }

}
