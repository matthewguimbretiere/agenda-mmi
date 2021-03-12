<?php

namespace App\Repository;

use App\Entity\Group;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Group|null find($id, $lockMode = null, $lockVersion = null)
 * @method Group|null findOneBy(array $criteria, array $orderBy = null)
 * @method Group[]    findAll()
 * @method Group[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Group::class);
    }

    /**
     * Obtenir un groupe par les paramètres donnés
     *
     * @param [type] $campain
     * @param [type] $semester
     * @param [type] $tp
     * @return void
     */
    public function findByCm($campain, $semester)
    {   
        // Obtenir l'id de la promo
        $idPromo = $this->createQueryBuilder('g')
                    ->andWhere('g.campain = :campain', 'g.semester = :semester', 'g.type = :type')
                    ->setParameter('campain', $campain)
                    ->setParameter('semester', $semester)
                    ->setParameter('type', 'CM')
                    ->getQuery()
                    ->getResult();            
        
        return $idPromo;
    }

    public function findByTd($campain, $semester, $td) {
        // Obtenir l'id du TD
        $idTd = $this->createQueryBuilder('g')
        ->andWhere('g.campain = :campain', 'g.semester = :semester', 'g.name = :td')
        ->setParameter('campain', $campain)
        ->setParameter('semester', $semester)
        ->setParameter('td', $td)
        ->getQuery()
        ->getResult();
        
        return $idTd;
    }

    public function findByTp($campain, $semester, $tp) {
        // Obtenir l'id du TP
        $idTp = $this->createQueryBuilder('g')
        ->andWhere('g.campain = :campain', 'g.semester = :semester', 'g.name = :tp')
        ->setParameter('campain', $campain)
        ->setParameter('semester', $semester)
        ->setParameter('tp', $tp)
        ->getQuery()
        ->getResult();

        return $idTp;
    }

    public function findYear() {
        //Recuperer le nom(bre) des années
        $Annees = $this->createQueryBuilder('g')
        ->andWhere('g.type = :type')
        ->setParameter('type', "CM")
        ->getQuery()
        ->getResult();

        return $Annees ;
    }

    public function findBySAC($semester, $campain) {
        // Obtenir les TP en fonction du semestre et de la campagne
        $Tps = $this->createQueryBuilder('g')
        ->andWhere('g.campain = :campain', 'g.semester = :semester', 'g.type = :type')
        ->setParameter('campain', $campain)
        ->setParameter('semester', $semester)
        ->setParameter('type', "TP")
        ->getQuery()
        ->getResult();
        
        return $Tps;
    }

    // /**
    //  * @return Group[] Returns an array of Group objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Group
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}