<?php

namespace App\Form;

use App\Entity\Group;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class GroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod($options["method"])
            ->setAction($options["action"])
            ->add('name', TextType::class, ['label' => 'Nom du groupe : ', 'attr' => ['placeholder' => 'TP3']])
            ->add('type', ChoiceType::class, ['label' => 'Type : ', 'choices'  => ['CM' => 'CM','TD' => 'TD','TP' => 'TP']])
            ->add('semester', TextType::class, ['label' => 'Semestre : ', 'attr' => ['placeholder' => 'S1']])
            ->add('campain', TextType::class, ['label' => 'Années universitaire : ', 'attr' => ['placeholder' => '2020-2021']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Group::class,
        ]);
    }
}