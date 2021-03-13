<?php

namespace App\Form;

use App\Entity\Group;
use App\Entity\Liens;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LiensType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod($options["method"])
            ->setAction($options["action"])
            ->add('TP', EntityType::class, ['class' => Group::class,'multiple'=> false,'expanded'=>false, 'label'=> 'Tp : '])
            ->add('TD', EntityType::class, ['class' => Group::class,'multiple'=> false,'expanded'=>false, 'label'=> 'Td : '])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Liens::class,
        ]);
    }
}