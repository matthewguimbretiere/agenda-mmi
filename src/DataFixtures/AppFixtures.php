<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use App\Entity\Group;
use App\Entity\Module;
use App\Entity\Teacher;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
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
            "email" => "blabla@gmail.com",
            "password" =>"azerty",
            "name" =>"Admin",
            "roles" =>"ROLE_ADMIN"
        ],
        [
            "email" =>"bleble@yahoo.fr",
            "password" =>"qwerty",
            "name" =>"Editor",
            "roles" =>"ROLE_EDITOR"
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
            "deadline" => "05/02/2021",
            "visible" => true
        ],
        [
            "description" => "Soutenance",
            "deadline" => "29/02/2021",
            "visible" => true
        ],
        [
            "description" => "Court-métrage",
            "deadline" => "16/02/2021",
            "visible" => true
        ],
        [
            "description" => "Faire l'exo 2",
            "deadline" => "30/02/2021",
            "visible" => true
        ],
        [
            "description" => "Finir la réalisation",
            "deadline" => "04/02/2021",
            "visible" => true
        ],
        [
            "description" => "Finir le TP7",
            "deadline" => "08/02/2021",
            "visible" => false
        ],
        [
            "description" => "Reviser le cours sur la radio",
            "deadline" => "09/02/2021",
            "visible" => true
        ],
        [
            "description" => "APPRENDRE DES ACTUS ESPAGNOLES",
            "deadline" => "13/02/2021",
            "visible" => true
        ],
        [
            "description" => "DS JavaScript",
            "deadline" => "10/02/2021",
            "visible" => true
        ],
        [
            "description" => "Apprendre à faire un débat",
            "deadline" => "01/02/2021",
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
            ->setPassword($user["password"])
            ->setName($user["name"])
            ->getRoles($user["roles"]);
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
            $nb++;
            $theTache = new Task ();
            $theTache -> setDescription($tache["description"])
            ->setDeadline($tache["deadline"])
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
        $manager->flush();
    }
}