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
    public function get_tasks( EntityManagerInterface $em) {
        $countTasks = $em->getRepository(Task::class)->getCount();

        dd($countTasks);
    }
}