<?php

namespace App\Form;

use App\Entity\Task;
use App\Entity\Group;
use App\Entity\Module;
use App\Entity\Teacher;
use App\Repository\GroupRepository;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;

class TaskType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        // Avoid calling getUser() in the constructor: auth may not
        // be complete yet. Instead, store the entire Security object.
        $this->security = $security;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->security->getUser();

        $builder
            ->setMethod($options["method"])
            ->setAction($options["action"])
            ->add('description', TextareaType::class, ['label'=> 'Description : '])
            ->add('deadline', DateType::class, ['label'=> 'À rendre pour le : '])
            ->add('visible', CheckboxType::class, ['label'=> 'Visible : ', 'attr'=>['value'=>'1']])
            ->add('teacher', EntityType::class, ['class' => Teacher::class,'multiple'=> false,'expanded'=>false, 'label'=> 'Professeur : '])
            ->add('module', EntityType::class, ['class' => Module::class,'multiple'=> false,'expanded'=>false, 'label'=> 'Module : '])
            ->add('groupes', EntityType::class, ['class' => Group::class,
                'choices' => $user->getGroupe(),
                'multiple'=> true,'expanded'=>false, 'label'=> 'Groupes : '])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}