<?php

namespace App\Controller;

use App\Entity\Teacher;
use App\Form\TeacherType;
use App\Repository\TaskRepository;
use App\Repository\TeacherRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BackTeacherController extends AbstractController
{
    /**
     * @Route("/admin/back-teacher", name="back-teacher", methods={"GET"})
     */
    public function list(TeacherRepository $teacherRepository, TaskRepository $taskRepository): Response
    {
        $teachers = $teacherRepository->findAll();
        $tasks = $taskRepository->findAll();
        
        return $this->render('backoffice/admin/teachers/list.html.twig', [
            'teachers' => $teachers,
            'tasks' => $tasks
        ]);
    }
    /**
     * @Route("/admin/back-teacher/add", name="back-teacher-add", methods={"GET", "POST"})
     */
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $teacher = new Teacher();
        $formTeacher = $this->createForm(TeacherType::class, $teacher, ["method" => 'POST', "action" => '/admin/back-teacher/add']);
        $formTeacher->handleRequest($request);
        if ($formTeacher->isSubmitted() && $formTeacher->isValid()) {
            $teacher = $formTeacher->getData();
            $em->persist($teacher);
            $em->flush();
            $this->addFlash('info', 'Succès !');
            return $this->redirectToRoute('back-teacher');
        }

        return $this->render('backoffice/admin/teachers/add.html.twig', [
            'formTeacher' => $formTeacher->createView(),
        ]);
    }
    
    /**
     * @Route("/admin/back-teacher/edit/{id}", name="back-teacher-edit", methods={"GET", "POST"})
     */
    public function edit(TeacherRepository $teacherRepository, $id, Request $request, EntityManagerInterface $em): Response
    {
        $theTeacher = $teacherRepository->find($id);

        $formTeacher = $this->createForm(TeacherType::class, $theTeacher, ["method" => 'POST', "action" => '/admin/back-teacher/edit/'.$id]);
        $formTeacher->handleRequest($request);
        if ($formTeacher->isSubmitted() && $formTeacher->isValid()) {
            $theTeacher = $formTeacher->getData();
            $em->persist($theTeacher);
            $em->flush();
            $this->addFlash('info', 'Succès !');
            return $this->redirectToRoute('back-teacher');
        }

        return $this->render('backoffice/admin/teachers/edit.html.twig', [
            'formTeacher' => $formTeacher->createView(),
        ]);
    }
    
    /**
     * @Route("/admin/back-teacher/delete/{id}", name="back-teacher-delete", methods={"GET", "DELETE"})
     */
    public function delete(Teacher $teacher, EntityManagerInterface $em): Response
    {
        $em->remove($teacher);
        $em->flush();
        return $this->redirectToRoute('back-teacher');
    }
}