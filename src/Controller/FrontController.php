<?php

namespace App\Controller;

use App\Repository\TaskRepository;
use App\Repository\GroupRepository;
use App\Repository\LiensRepository;
use App\Repository\ModuleRepository;
use App\Repository\TeacherRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="front-index")
     */
    public function index(Request $request, GroupRepository $groupRepository, LiensRepository $liensRepository): Response
    {
        $Annees = $groupRepository->findYear();
        $TPs = [];
        foreach ($Annees as $Annee) {
            array_push($TPs, $groupRepository->findBySAC($Annee->getSemester(), $Annee->getCampain()));
        }

        $vraiTp = [];
        foreach ($TPs as $semesters) {
            foreach ($semesters as $tp) {
                array_push($vraiTp, [
                    "id" => $tp->getId(),
                    "name" => $tp->getName(),
                    "type" => $tp->getType(),
                    "semester" => $tp->getSemester(),
                    "campain" => $tp->getCampain(),
                    "tasks" => $tp->getTasks(),
                    "liens" => $liensRepository->findBy(['TP' => $tp->getId()])
                ]);
            }
        }

        // Un grand tableau
        $grandTableau = [];

        $grandTableau["annees"] = $Annees;
        $grandTableau["nbAnnees"] = count($Annees);
        $grandTableau["tps"] = $vraiTp;
        
        return $this->render('front/index.html.twig', [
            'donnees' => $grandTableau,
        ]);
    }

    /**
     * @Route("/{campain}/{semester}/td/{td}/tp/{tp}", name="front-tp-all")
     */
    public function agenda($campain, $semester, $td = null, $tp = null, TaskRepository $taskRepository, GroupRepository $groupRepository)
    {
        $results = [];
        
        // Si on demande tout
        if( $td != "null" AND $tp != "null" ) {
            $results[] = $groupRepository->findByTp( $campain, $semester, $tp);
            $results[] = $groupRepository->findByTd( $campain, $semester, $td);
            $results[] = $groupRepository->findByCm( $campain, $semester );
        }
        
        return $this->render('front/agenda.html.twig', [
            'groups' => $results,
            'datas' => ['campain' => $campain, 'semester' => $semester, 'td' => $td, 'tp' => $tp]
        ]);
    }
}