<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Task;
use App\Entity\User;
use App\Entity\Group;
use App\Entity\Module;
use App\Entity\Teacher;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    private $passwordEncoder;
    // injecter la classe de cryptage dans le service
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    const ENSEIGNANTS = [
        ["name" => "Bernadette Chaulet"],
        ["name" => "François Louët"],
        ["name" => "Fathallah Daghmi"],
        ["name" => "Cristina Badulescu"],
        ["name" => "Olivier Gineste"],
        ["name" => "Stephanie Delayre"],
        ["name" => "Didier Galonnier"],
        ["name" => "Smail Bachir"],
        ["name" => "Carole Couegnas"],
        ["name" => "Fabien Rebillier"]
    ];

    const USERS = [
        [
            "email" => "boss@mmi.edu",
            "password" =>"boss",
            "roles" =>"ROLE_ADMIN"
        ],
        [
            "email" =>"marcel@mmi.edu",
            "password" =>"bouzigue",
            "roles" =>"ROLE_WRITER"
        ]
    ];

    const MODULES = [
        [
          "name" => "Anglais",
          "year" => 2020, 
          "campain" => "2020/2021"
        ],
        [
          "name" => "Espagnol",
          "year" => 2020, 
          "campain" => "2020/2021"
        ],
        [
          "name" => "TIC",
          "year" => 2020, 
          "campain" => "2020/2021"
        ],
        [
          "name" => "EMN",
          "year" => 2020, 
          "campain" => "2020/2021"
        ],
        [
          "name" => "Expression",
          "year" => 2020, 
          "campain" => "2020/2021"
        ],
        [
          "name" => "Audiovisuel",
          "year" => 2020, 
          "campain" => "2020/2021"
        ],
        [
          "name" => "Algo",
          "year" => 2020, 
          "campain" => "2020/2021"
        ],
        [
          "name" => "Devweb",
          "year" => 2020, 
          "campain" => "2020/2021"
        ],
        [
          "name" => "Infographie",
          "year" => 2020, 
          "campain" => "2020/2021"
        ],
        [
          "name" => "PTUT",
          "year" => 2020, 
          "campain" => "2020/2021"
        ]
      ];

      const TACHES = [
        [
            "description" => "Exposé sur les girafes",
            "visible" => true
        ],
        [
            "description" => "Soutenance",
            "visible" => true
        ],
        [
            "description" => "Court-métrage",
            "visible" => true
        ],
        [
            "description" => "Faire l'exo 2",
            "visible" => true
        ],
        [
            "description" => "Finir la réalisation",
            "visible" => true
        ],
        [
            "description" => "Finir le TP7",
            "visible" => false
        ],
        [
            "description" => "Reviser le cours sur la radio",
            "visible" => true
        ],
        [
            "description" => "APPRENDRE DES ACTUS ESPAGNOLES",
            "visible" => true
        ],
        [
            "description" => "DS JavaScript",
            "visible" => true
        ],
        [
            "description" => "Apprendre à faire un débat",
            "visible" => true
        ]
      ];
      
      const GROUPES = [
        [
          "name" => "MMI1",
          "type" => "CM",
          "semester" => "S1",
          "campain" => "2020/2021"
        ],
        [
          "name" => "MMI2",
          "type" => "CM",
          "semester" => "S3",
          "campain" => "2020/2021"
        ],
        [
          "name" => "TDA",
          "type" => "TD",
          "semester" => "S1",
          "campain" => "2020/2021"
        ],
        [
          "name" => "TDB",
          "type" => "TD",
          "semester" => "S1",
          "campain" => "2020/2021"
        ],
        [
          "name" => "TDA",
          "type" => "TD",
          "semester" => "S3",
          "campain" => "2020/2021"
        ],
        [
          "name" => "TDB",
          "type" => "TD",
          "semester" => "S3",
          "campain" => "2020/2021"
        ],
        [
          "name" => "TP1",
          "type" => "TP",
          "semester" => "S1",
          "campain" => "2020/2021"
        ], 
        [
          "name" => "TP2",
          "type" => "TP",
          "semester" => "S1",
          "campain" => "2020/2021"
        ],
        [
          "name" => "TP3",
          "type" => "TP",
          "semester" => "S1",
          "campain" => "2020/2021"
        ],
        [
          "name" => "TP4",
          "type" => "TP",
          "semester" => "S1",
          "campain" => "2020/2021"
        ],
        [
          "name" => "TP1",
          "type" => "TP",
          "semester" => "S3",
          "campain" => "2020/2021"
        ],
        [
          "name" => "TP2",
          "type" => "TP",
          "semester" => "S3",
          "campain" => "2020/2021"
        ],
        [
          "name" => "TP3",
          "type" => "TP",
          "semester" => "S3",
          "campain" => "2020/2021"
        ],
        [
          "name" => "TP4",
          "type" => "TP",
          "semester" => "S3",
          "campain" => "2020/2021"
        ]
      ]; 
    public function load(ObjectManager $manager)
    {
        $this->loadGroup($manager);
        $this->loadUser($manager);
        $this->loadModule($manager);
        $this->loadTeacher($manager);
        $this->loadTask($manager);
    }

    public function loadGroup(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::GROUPES as $group) {
            $i++;
            $theGroup = new Group ();
            $theGroup -> setName($group["name"])
                      -> setType($group["type"])
                      -> setSemester($group["semester"])
                      -> setCampain($group["campain"]);
            $manager ->persist($theGroup);
            $this -> addReference("theGroup-$i",$theGroup);
        }
        $manager->flush();

    }

    public function loadUser(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::USERS as $user) {
            $i++;
            $theUser = new User ();
            $theUser -> setEmail($user["email"])
            ->setPassword($this->passwordEncoder->encodePassword($theUser,$user["password"]))
            ->setRoles([$user["roles"]]);
            $manager ->persist($theUser);
        }
        $manager->flush();
        
    }

    public function loadTeacher(ObjectManager $manager)
    {
        $nb = 0;
        foreach (self::ENSEIGNANTS as $enseignant) {
            $nb++;
            $nbMod = rand(1,2);
            $theEnseignant = new Teacher ();
            $theEnseignant -> setName($enseignant["name"]);
            for ($i=0; $i <= $nbMod; $i++) { 
              $module = rand(1,count(self::MODULES));
              $theEnseignant -> addModule($this->getReference("theModule-$module"));
            }
            $manager ->persist($theEnseignant);
            $this -> addReference("theEnseignant-$nb",$theEnseignant);
        }
        $manager->flush();
    }

    public function loadModule(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::MODULES as $module) {
            $i++;
            $theModule = new Module ();
            $theModule ->setName($module["name"])
            ->setYear($module["year"])
            ->setCampain($module["campain"]);
            $manager ->persist($theModule);
            $this -> addReference("theModule-$i",$theModule);
        }
        $manager->flush();
    }

    public function loadTask(ObjectManager $manager)
    {
        $nb = 0;
        foreach (self::TACHES as $tache) {
            $aEns = rand(1,count(self::ENSEIGNANTS));
            $aMod = rand(1,count(self::MODULES));
            $nbGroup = rand(1,3);
            $dateDay = rand(1,28);
            $nb++;
            $theTache = new Task ();
            $theTache -> setDescription($tache["description"])
            ->setDeadline(new \DateTime('2020-08-10'))
            ->setVisible($tache["visible"])
            ->setTeacher($this->getReference("theEnseignant-$aEns"))
            ->setModule($this->getReference("theModule-$aMod"));

            //boucle groupe
            for ($i=0; $i < $nbGroup; $i++) { 
              $groupe = rand(1,count(self::GROUPES));

              $theTache -> addGroupe($this->getReference("theGroup-$groupe"));
            }
            
            $manager ->persist($theTache);
        }
        dump($manager);
        $manager->flush();
    }

}