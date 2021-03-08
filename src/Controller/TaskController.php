<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Task;
use App\Entity\Teacher;
use App\Entity\Group;
use App\Entity\Module;
use App\Repository\GroupRepository;
use App\Repository\ModuleRepository;
use App\Repository\TaskRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TaskController extends AbstractController
{
    /**
     * @Route("/task", name="task")
     */
    public function index(): Response
    {
        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
        ]);
    }

    /**
     * @Route("/tasks", name="get_tasks")
     */
    public function get_tasks( TaskRepository $taskRepository, GroupRepository $groupRepository, EntityManagerInterface $em, ModuleRepository $moduleRepository) {

        //$task = $taskRepository->find(30);

        //dd($task->getModule()->getName());

        $tp3 = $groupRepository->findOneBy(['semester' => 'S3', 'name' => 'TP3']);
        dd($tp3->getTasks()->filter(function ($item) {  return $item->getVisible() == false ;}));
    }
}