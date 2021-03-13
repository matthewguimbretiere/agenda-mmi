<?php

namespace App\Controller;

use App\Repository\GroupRepository;
use App\Repository\LiensRepository;
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
    public function index(GroupRepository $groupRepository, LiensRepository $liensRepository): Response
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

        $grandTableau["annes"] = $Annees;
        $grandTableau["nbAnnes"] = count($Annees);
        $grandTableau["tps"] = $vraiTp;
        
        return $this->render('front/index.html.twig', [
            'groupes' => $groupRepository->findYear(),
        ]);
    }

    /**
     * @Route("/{campain}/{semester}/{td}/{tp}", name="front-tp-all")
     * @Route("/{campain}/{semester}/{td}", name="front-td-unique")
     * @Route("/{campain}/{semester}/{tp}", name="front-tp-unique")
     * @Route("/{campain}/{semester}", name="front-cm-unique")
     */
    public function agenda($campain, $semester, $td = null, $tp = null, TaskRepository $taskRepository, GroupRepository $groupRepository)
    {
        $results = [];
        
        // Si on demande tout
        if( $td != null && $tp != null ) {
            $results[] = $groupRepository->findByCm( $campain, $semester );
            $results[] = $groupRepository->findByTp( $campain, $semester, $tp);
            $results[] = $groupRepository->findByTd( $campain, $semester, $td);
        // Si on demande que les Tp
        } elseif ( $td == null && $tp != null ) {
            $results[] = $groupRepository->findByTp( $campain, $semester, $tp);
        // Si on demande que les Td
        } elseif ( $tp == null && $td != null ) {
            $results[] = $groupRepository->findByTd( $campain, $semester, $td);
        // Si on demande que les CM
        } else {
            $results[] = $groupRepository->findByCm( $campain, $semester );
        }
        
        return $this->render('front/agenda.html.twig', [
            'groups' => $results
        ]);
    }
}