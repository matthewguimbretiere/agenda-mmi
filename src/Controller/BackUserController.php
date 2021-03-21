<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManager;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class BackUserController extends AbstractController
{
    private $passwordEncoder;
    // injecter la classe de cryptage dans le service
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
    $this->passwordEncoder = $passwordEncoder;
    }
 
    /**
     * @Route("/admin/back-user", name="back-user", methods={"GET"})
     */
    public function list(UserRepository $userRepository): Response
    {
        $writers = $userRepository->findAll();

        dd($writers);

        return $this->render('backoffice/admin/users/list.html.twig', [
            'writers' => $writers,
        ]);
    }
    /**
     * @Route("/admin/back-user/add", name="back-user-add", methods={"GET", "POST"})
     */
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $theUser = new User();
        $formUser = $this->createForm(UserType::class, $theUser);
        $formUser->handleRequest($request);
        if ($formUser->isSubmitted() && $formUser->isValid()) {
            $user = $formUser->getData();
            $theUser -> setEmail($user->getEmail())
            ->setPassword($this->passwordEncoder->encodePassword($theUser, $user->getPassword()))
            ->setRoles($user->getRoles());
            $em->persist($theUser);
            $em->flush();
            $this->addFlash('info', 'Succès !');
            return $this->redirectToRoute('back-user');
        }

        return $this->render('backoffice/admin/users/add.html.twig', [
            'formUser' => $formUser->createView(),
        ]);
    }
    /**
     * @Route("/admin/back-user/edit/{id}", name="back-user-edit", methods={"GET", "POST"})
     */
    public function edit(UserRepository $userRepository, $id, Request $request, EntityManagerInterface $em): Response
    {
        $theUser = $userRepository->find($id);

        $formUser = $this->createForm(UserType::class, $theUser, ["method" => 'POST', "action" => '/admin/back-user/edit/'.$id]);
        $formUser->handleRequest($request);
        if ($formUser->isSubmitted() && $formUser->isValid()) {
            $theUser = $formUser->getData();
            $em->persist($theUser);
            $em->flush();
            $this->addFlash('info', 'Succès !');
            return $this->redirectToRoute('back-user');
        }

        return $this->render('backoffice/admin/users/edit.html.twig', [
            'formUser' => $formUser->createView(),
        ]);
    }
    /**
     * @Route("/admin/back-user/delete/{id}", name="back-user-delete", methods={"GET", "DELETE"})
     */
    public function delete(User $user, EntityManagerInterface $em): Response
    {
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute('back-user');
    }
}