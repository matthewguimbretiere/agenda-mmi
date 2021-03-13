<?php

namespace App\Controller;

use App\Entity\Group;
use App\Form\GroupType;
use App\Repository\GroupRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BackGroupeController extends AbstractController
{
    /**
     * @Route("/admin/back-group", name="back-group", methods={"GET"})
     */
    public function list(GroupRepository $groupRepository): Response
    {
        $groups = $groupRepository->findAll();

        dd($groups);
        
        return $this->render('backoffice/admin/group/list.html.twig', [
            'groups' => $groups,
        ]);
    }
    /**
     * @Route("/admin/back-group/add", name="back-group-add", methods={"GET", "POST"})
     */
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $group = new Group();
        $formGroup = $this->createForm(GroupType::class, $group, ["method" => 'POST', "action" => '/admin/back-group/add']);
        $formGroup->handleRequest($request);
        if ($formGroup->isSubmitted() && $formGroup->isValid()) {
            $group = $formGroup->getData();
            $em->persist($group);
            $em->flush();
            $this->addFlash('info', 'Succès !');
            return $this->redirectToRoute('back-group');
        }

        return $this->render('backoffice/admin/group/add.html.twig', [
            'formGroup' => $formGroup->createView(),
        ]);
    }
    
    /**
     * @Route("/admin/back-group/edit/{id}", name="back-group-edit", methods={"GET", "POST"})
     */
    public function edit(GroupRepository $groupRepository, $id, Request $request, EntityManagerInterface $em): Response
    {
        $theGroup = $groupRepository->find($id);

        $formGroup = $this->createForm(GroupType::class, $theGroup, ["method" => 'POST', "action" => '/admin/back-group/edit/'.$id]);
        $formGroup->handleRequest($request);
        if ($formGroup->isSubmitted() && $formGroup->isValid()) {
            $theGroup = $formGroup->getData();
            $em->persist($theGroup);
            $em->flush();
            $this->addFlash('info', 'Succès !');
            return $this->redirectToRoute('back-group');
        }

        return $this->render('backoffice/admin/group/edit.html.twig', [
            'formGroup' => $formGroup->createView(),
        ]);
    }
    
    /**
     * @Route("/admin/back-group/delete/{id}", name="back-group-delete", methods={"GET", "DELETE"})
     */
    public function delete(Group $group, EntityManagerInterface $em): Response
    {
        $em->remove($group);
        $em->flush();
        return $this->redirectToRoute('back-group');
    }
}