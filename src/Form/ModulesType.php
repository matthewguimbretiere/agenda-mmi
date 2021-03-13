<?php

namespace App\Form;

use App\Entity\Module;
use App\Entity\Teacher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ModulesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod($options["method"])
            ->setAction($options["action"])
            ->add('name', TextType::class, ['label' => 'Nom du module : ', 'attr' => ['placeholder' => 'Dév. web']])
            ->add('semester', TextType::class, ['label' => 'Semestre : ', 'attr' => ['placeholder' => 'S1']])
            ->add('campain', TextType::class, ['label' => 'Années universitaire : ', 'attr' => ['placeholder' => '2020-2021']])
            ->add('teachers', EntityType::class, ['class' => Teacher::class,'multiple'=> true,'expanded'=>false, 'label'=> 'Enseignants : '])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Module::class,
        ]);
    }
}