<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BackGroupeController extends AbstractController
{
    /**
     * @Route("/admin/back-user", name="back-user", methods={"GET"})
     */
    public function list(): Response
    {
        return $this->render('backoffice/admin/user/list.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    /**
     * @Route("/admin/back-user/add", name="back-user-add", methods={"GET"})
     */
    public function add(): Response
    {
        return $this->render('backoffice/admin/user/index.html.twig', [
            'controller_name' => 'AdminController',
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