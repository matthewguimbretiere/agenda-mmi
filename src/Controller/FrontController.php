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
     * @Route("/{campain}/{semester}/{tp}", name="front-tp")
     */
    public function agenda(TaskRepository $taskRepository, Request $request)
    {
        return $this->render('front/agenda.html.twig', [
            'tasks' => $taskRepository->findByTp($request->query->get('campain'), $request->query->get('semester'), $request->query->get('tp'))
        ]);
    }
}