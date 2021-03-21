<?php

namespace App\Controller;

use App\Entity\Liens;
use App\Form\LiensType;
use App\Repository\LiensRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BackLiensController extends AbstractController
{
    /**
     * @Route("/admin/back-liens", name="back-liens", methods={"GET"})
     */
    public function list(LiensRepository $liensRepository): Response
    {
        $liens = $liensRepository->findAll();
        
        return $this->render('backoffice/admin/liens/list.html.twig', [
            'liens' => $liens,
        ]);
    }
    /**
     * @Route("/admin/back-liens/add", name="back-liens-add", methods={"GET", "POST"})
     */
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $liens = new Liens();
        $formLiens = $this->createForm(LiensType::class, $liens, ["method" => 'POST', "action" => '/admin/back-liens/add']);
        $formLiens->handleRequest($request);
        if ($formLiens->isSubmitted() && $formLiens->isValid()) {
            $liens = $formLiens->getData();
            $em->persist($liens);
            $em->flush();
            $this->addFlash('info', 'Succès !');
            return $this->redirectToRoute('back-liens');
        }

        return $this->render('backoffice/admin/liens/add.html.twig', [
            'formLiens' => $formLiens->createView(),
        ]);
    }
    
    /**
     * @Route("/admin/back-liens/edit/{id}", name="back-liens-edit", methods={"GET", "POST"})
     */
    public function edit(LiensRepository $liensRepository, $id, Request $request, EntityManagerInterface $em): Response
    {
        $theLiens = $liensRepository->find($id);

        $formLiens = $this->createForm(LiensType::class, $theLiens, ["method" => 'POST', "action" => '/admin/back-liens/edit/'.$id]);
        $formLiens->handleRequest($request);
        if ($formLiens->isSubmitted() && $formLiens->isValid()) {
            $theLiens = $formLiens->getData();
            $em->persist($theLiens);
            $em->flush();
            $this->addFlash('info', 'Succès !');
            return $this->redirectToRoute('back-liens');
        }

        return $this->render('backoffice/admin/liens/edit.html.twig', [
            'formLiens' => $formLiens->createView(),
        ]);
    }
    
    /**
     * @Route("/admin/back-liens/delete/{id}", name="back-liens-delete", methods={"GET", "DELETE"})
     */
    public function delete(Liens $liens, EntityManagerInterface $em): Response
    {
        $em->remove($liens);
        $em->flush();
        return $this->redirectToRoute('back-liens');
    }
}