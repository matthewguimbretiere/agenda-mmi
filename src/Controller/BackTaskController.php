<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;

class BackTaskController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        // Avoid calling getUser() in the constructor: auth may not
        // be complete yet. Instead, store the entire Security object.
        $this->security = $security;
    }
    
    /**
     * @Route("/writer/back-task", name="back-task", methods={"GET"})
     */
    public function list(TaskRepository $taskRepository): Response
    {
        $tab = array();
        $tasks = $taskRepository->findAll();
        $user =  $this->security->getUser();
        foreach($tasks as $task) {
            foreach($task->getGroupes() as $groupe ) {
                foreach ($user->getGroupe() as $userGroup) {                
                    if($groupe == $userGroup) {
                        $tab[] = $task;
                    }
                }
            }
        }
        
        return $this->render('backoffice/writer/task/list.html.twig', [
            'tasks' => $tab,
        ]);
    }
    /**
     * @Route("/writer/back-task/add", name="back-task-add", methods={"GET", "POST"})
     */
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $task = new Task();
        $formTask = $this->createForm(TaskType::class, $task, ["method" => 'POST', "action" => '/writer/back-task/add']);
        $formTask->handleRequest($request);
        if ($formTask->isSubmitted() && $formTask->isValid()) {
            $task = $formTask->getData();
            $em->persist($task);
            $em->flush();
            $this->addFlash('info', 'Succès !');
            return $this->redirectToRoute('back-task');
        }

        return $this->render('backoffice/writer/task/add.html.twig', [
            'formTask' => $formTask->createView(),
        ]);
    }
    /**
     * @Route("/writer/back-task/edit/{id}", name="back-task-edit", methods={"GET", "POST"})
     */
    public function edit(TaskRepository $taskRepository, $id, Request $request, EntityManagerInterface $em): Response
    {
        $theTask = $taskRepository->find($id);

        $formTask = $this->createForm(TaskType::class, $theTask, ["method" => 'POST', "action" => '/writer/back-task/edit/'.$id]);
        $formTask->handleRequest($request);
        if ($formTask->isSubmitted() && $formTask->isValid()) {
            $theTask = $formTask->getData();
            $em->persist($theTask);
            $em->flush();
            $this->addFlash('info', 'Succès !');
            return $this->redirectToRoute('back-task');
        }

        return $this->render('backoffice/writer/task/edit.html.twig', [
            'formTask' => $formTask->createView(),
        ]);
    }
    /**
     * @Route("/writer/back-task/delete/{id}", name="back-task-delete", methods={"GET", "DELETE"})
     */
    public function delete(Task $task, EntityManagerInterface $em): Response
    {
        $em->remove($task);
        $em->flush();
        return $this->redirectToRoute('back-task');
    }
}