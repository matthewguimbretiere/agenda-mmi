<?php

namespace App\Controller;

use App\Repository\GroupRepository;
use App\Repository\ModuleRepository;
use App\Repository\TaskRepository;
use App\Repository\TeacherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="front-index")
     */
    public function index(GroupRepository $groupRepository): Response
    {
        return $this->render('front/index.html.twig', [
            'groupes' => $groupRepository->findAll()  
        ]);
    }

    /**
     * @Route("/{campain}/{semester}/{td}/{tp}", name="front-tp")
     */
    public function agenda($campain, $semester, $td, $tp, TaskRepository $taskRepository, GroupRepository $groupRepository)
    {
        // Obtenir les ids des tp/td/cm correspondant à l'url
        $groups = $groupRepository->findByParameters($campain, $semester, $td, $tp);
        
        
        return $this->render('front/agenda.html.twig', [
            'groups' => $groups
        ]);
    }
}