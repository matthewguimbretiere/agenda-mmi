<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManager;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BackUserController extends AbstractController
{
    /**
     * @Route("/admin/back-user", name="back-user", methods={"GET"})
     */
    public function list(UserRepository $userRepository): Response
    {
        $writers = $userRepository->findAll();

        return $this->render('backoffice/admin/users/list.html.twig', [
            'writers' => $writers,
        ]);
    }
    /**
     * @Route("/admin/back-user/add", name="back-user-add", methods={"GET"})
     */
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $user = new User();
        $formUser = $this->createForm(UserType::class, $user);
        $formUser->handleRequest($request);
        if ($formUser->isSubmitted() && $formUser->isValid()) {
            $user = $formUser->getData();
            $em->persist($user);
            $em->flush();
            $this->addFlash('info', 'Succès !');
            return $this->redirectToRoute('back-user');
        }

        return $this->render('backoffice/admin/users/add.html.twig', [
            'formUser' => $formUser->createView(),
        ]);
    }
    /**
     * @Route("/admin/back-user/save", name="back-user-save", methods={"POST"})
     */
    public function save(): Response
    {
        return $this->redirectToRoute('back-user');
    }
    /**
     * @Route("/admin/back-user/edit/{id}", name="back-user-edit", methods={"GET"})
     */
    public function edit(): Response
    {
        return $this->render('backoffice/admin/user/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    /**
     * @Route("/admin/back-user/update/{id}", name="back-user-update", methods={"GET", "POST" })
     */
    public function update(): Response
    {
        return $this->redirectToRoute('back-user');
    }
    /**
     * @Route("/admin/back-user/delete/{id}", name="back-user-delete", methods={"GET", "DELETE"})
     */
    public function delete(): Response
    {
        return $this->redirectToRoute('back-user');
    }
}