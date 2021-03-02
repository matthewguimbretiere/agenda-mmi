<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Group;
use App\Entity\Module;
use App\Entity\Task;
use App\Entity\Teacher;
use App\Entity\User;

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
          "compain" => "2020/2021"
        ],
        [
          "name" => "Espagnol",
          "year" => 2020, 
          "compain" => "2020/2021"
        ],
        [
          "name" => "TIC",
          "year" => 2020, 
          "compain" => "2020/2021"
        ],
        [
          "name" => "EMN",
          "year" => 2020, 
          "compain" => "2020/2021"
        ],
        [
          "name" => "Expression",
          "year" => 2020, 
          "compain" => "2020/2021"
        ],
        [
          "name" => "Audiovisuel",
          "year" => 2020, 
          "compain" => "2020/2021"
        ],
        [
          "name" => "Algo",
          "year" => 2020, 
          "compain" => "2020/2021"
        ],
        [
          "name" => "Devweb",
          "year" => 2020, 
          "compain" => "2020/2021"
        ],
        [
          "name" => "Infographie",
          "year" => 2020, 
          "compain" => "2020/2021"
        ],
        [
          "name" => "PTUT",
          "year" => 2020, 
          "compain" => "2020/2021"
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
        ],,
        [
          "name" => "TP2",
          "type" => "TP",
          "semester" => "S1",
          "campain" => "2020/2021"
        ],,
        [
          "name" => "TP3",
          "type" => "TP",
          "semester" => "S1",
          "campain" => "2020/2021"
        ],,
        [
          "name" => "TP4",
          "type" => "TP",
          "semester" => "S1",
          "campain" => "2020/2021"
        ],,
        [
          "name" => "TP1",
          "type" => "TP",
          "semester" => "S3",
          "campain" => "2020/2021"
        ],,
        [
          "name" => "TP2",
          "type" => "TP",
          "semester" => "S3",
          "campain" => "2020/2021"
        ],,
        [
          "name" => "TP3",
          "type" => "TP",
          "semester" => "S3",
          "campain" => "2020/2021"
        ],,
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
        
    }

    public function loadTeacher(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::ENSEIGNANTS as $enseignant) {
            $i++;
            $theEnseignant = new Group ();
            $theEnseignant -> setName($enseignant["name"])
            -> setModules($enseignant["modules"]);
            $manager ->persist($theEnseignant);
            $this -> addReference("theEnseignant-$i",$theEnseignant);
        }
    }

    public function loadModule(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::MODULES as $module) {
            $i++;
            $ = new Group ();
            $ -> set
            $manager ->persist($);
            $this -> addReference("-$i",$);
        }
    }

    public function loadTask(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::TACHES as $tache) {
            $i++;
            $ = new Group ();
            $ -> set
            $manager ->persist($);
        }
    }
}