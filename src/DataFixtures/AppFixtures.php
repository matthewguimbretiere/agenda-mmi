<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Task;
use App\Entity\User;
use App\Entity\Group;
use App\Entity\Module;
use App\Entity\Teacher;
use App\Entity\Liens;
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
        "semester" => "S2", 
        "campain" => "2020-2021"
      ],
      [
        "name" => "Espagnol",
        "semester" => "S3", 
        "campain" => "2020-2021"
      ],
      [
        "name" => "TIC",
        "semester" => "S4", 
        "campain" => "2020-2021"
      ],
      [
        "name" => "EMN",
        "semester" => "S1", 
        "campain" => "2020-2021"
      ],
      [
        "name" => "Expression",
        "semester" => "S1", 
        "campain" => "2020-2021"
      ],
      [
        "name" => "Audiovisuel",
        "semester" => "S1", 
        "campain" => "2020-2021"
      ],
      [
        "name" => "Algo",
        "semester" => "S2", 
        "campain" => "2020-2021"
      ],
      [
        "name" => "Devweb",
        "semester" => "S3", 
        "campain" => "2020-2021"
      ],
      [
        "name" => "Infographie",
        "semester" => "S3", 
        "campain" => "2020-2021"
      ],
      [
        "name" => "PTUT",
        "semester" => "S1", 
        "campain" => "2020-2021"
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
            "description" => "Regarder un documentaire sur les dauphins",
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
          "name" => "MMI - 1ère année",
          "type" => "CM",
          "semester" => "S1",
          "campain" => "2020-2021"
        ],
        [
          "name" => "MMI - 2eme année",
          "type" => "CM",
          "semester" => "S3",
          "campain" => "2020-2021"
        ],
        [
          "name" => "TDA - 1ère année",
          "type" => "TD",
          "semester" => "S1",
          "campain" => "2020-2021"
        ],
        [
          "name" => "TDB - 1ère année",
          "type" => "TD",
          "semester" => "S1",
          "campain" => "2020-2021"
        ],
        [
          "name" => "TDA - 2eme année",
          "type" => "TD",
          "semester" => "S3",
          "campain" => "2020-2021"
        ],
        [
          "name" => "TDB - 2eme année",
          "type" => "TD",
          "semester" => "S3",
          "campain" => "2020-2021"
        ],
        [
          "name" => "TP1 - 1ère année",
          "type" => "TP",
          "semester" => "S1",
          "campain" => "2020-2021"
        ], 
        [
          "name" => "TP2 - 1ère année",
          "type" => "TP",
          "semester" => "S1",
          "campain" => "2020-2021"
        ],
        [
          "name" => "TP3 - 1ère année",
          "type" => "TP",
          "semester" => "S1",
          "campain" => "2020-2021"
        ],
        [
          "name" => "TP4 - 1ère année",
          "type" => "TP",
          "semester" => "S1",
          "campain" => "2020-2021"
        ],
        [
          "name" => "TP1 - 2eme année",
          "type" => "TP",
          "semester" => "S3",
          "campain" => "2020-2021"
        ],
        [
          "name" => "TP2 - 2eme année",
          "type" => "TP",
          "semester" => "S3",
          "campain" => "2020-2021"
        ],
        [
          "name" => "TP3 - 2eme année",
          "type" => "TP",
          "semester" => "S3",
          "campain" => "2020-2021"
        ],
        [
          "name" => "TP4 - 2eme année",
          "type" => "TP",
          "semester" => "S3",
          "campain" => "2020-2021"
        ]
      ]; 
    public function load(ObjectManager $manager)
    {
        $this->loadGroup($manager);
        $this->loadUser($manager);
        $this->loadModule($manager);
        $this->loadTeacher($manager);
        $this->loadTask($manager);
        $this->loadLiens($manager);
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
            if ($group["type"] == "TP") {
              $this -> addReference("theTP-$i",$theGroup);
            }
            if ($group["type"] == "TD") {
              $this -> addReference("theTD-$i",$theGroup);
            }
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
            $isAdmin = 0;
            if ($user["roles"]=="ROLE_ADMIN") {
              $isAdmin = 1;
            }
            if ($isAdmin == 1) {
              $a = 0;
              foreach (self::GROUPES as $groupe) {
                $a++;
                $theUser -> addGroupe($this->getReference("theGroup-$a"));
              }
            }else{
              $r = rand(1,count(self::GROUPES));
              $theUser -> addGroupe($this->getReference("theGroup-$r"));
            }
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
            ->setSemester($module["semester"])
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
            $day = rand(1,30);
            $aEns = rand(1,count(self::ENSEIGNANTS));
            $aMod = rand(1,count(self::MODULES));
            $nbGroup = rand(1,3);
            $dateDay = rand(1,28);
            $nb++;
            $theTache = new Task ();
            $theTache -> setDescription($tache["description"])
            ->setDeadline(new \DateTime('2021-04-' . $day))
            ->setVisible($tache["visible"])
            ->setTeacher($this->getReference("theEnseignant-$aEns"))
            ->setModule($this->getReference("theModule-$aMod"));

            //boucle groupe
            for ($i=1; $i <= $nbGroup; $i++) { 
              $groupe = rand(1,count(self::GROUPES));
              $theTache -> addGroupe($this->getReference("theGroup-$groupe"));
            }
            
            $manager ->persist($theTache);
        }
        $manager->flush();
    }

    public function loadLiens(ObjectManager $manager)
    {
      $nb = 7;
      for ($i=3; $i < 7; $i++) {
        $max = $nb+2;
        for ($nb; $nb < $max; $nb++) { 
          $theLien = new Liens ();
          $theLien -> setTP($this->getReference("theTP-$nb"));
          $theLien -> setTD($this->getReference("theTD-$i"));
          $manager ->persist($theLien);
        }
      }
      $manager->flush();
    }
}