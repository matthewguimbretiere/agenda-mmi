<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\ModulesType;
use App\Repository\ModuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class BackModuleController extends AbstractController
{
    /**
     * @Route("/admin/back-modules", name="back-modules", methods={"GET"})
     */
    public function list(AuthenticationUtils $authenticationUtils, ModuleRepository $moduleRepository): Response
    {
        
        dd($authenticationUtils);
        $modules = $moduleRepository->findAll();
        
        return $this->render('backoffice/admin/modules/list.html.twig', [
            'modules' => $modules,
        ]);
    }
    /**
     * @Route("/admin/back-modules/add", name="back-modules-add", methods={"GET", "POST"})
     */
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $modules = new Module();
        $formModules = $this->createForm(ModulesType::class, $modules, ["method" => 'POST', "action" => '/admin/back-modules/add']);
        $formModules->handleRequest($request);
        if ($formModules->isSubmitted() && $formModules->isValid()) {
            $modules = $formModules->getData();
            $em->persist($modules);
            $em->flush();
            $this->addFlash('info', 'Succès !');
            return $this->redirectToRoute('back-modules');
        }

        return $this->render('backoffice/admin/modules/add.html.twig', [
            'formModules' => $formModules->createView(),
        ]);
    }
    
    /**
     * @Route("/admin/back-modules/edit/{id}", name="back-modules-edit", methods={"GET", "POST"})
     */
    public function edit(ModuleRepository $moduleRepository, $id, Request $request, EntityManagerInterface $em): Response
    {
        $theModule = $moduleRepository->find($id);

        $formModules = $this->createForm(ModulesType::class, $theModule, ["method" => 'POST', "action" => '/admin/back-modules/edit/'.$id]);
        $formModules->handleRequest($request);
        if ($formModules->isSubmitted() && $formModules->isValid()) {
            $theModule = $formModules->getData();
            $em->persist($theModule);
            $em->flush();
            $this->addFlash('info', 'Succès !');
            return $this->redirectToRoute('back-modules');
        }

        return $this->render('backoffice/admin/modules/edit.html.twig', [
            'formModules' => $formModules->createView(),
        ]);
    }
    
    /**
     * @Route("/admin/back-modules/delete/{id}", name="back-modules-delete", methods={"GET", "DELETE"})
     */
    public function delete(Module $module, EntityManagerInterface $em): Response
    {
        $em->remove($module);
        $em->flush();
        return $this->redirectToRoute('back-modules');
    }
}