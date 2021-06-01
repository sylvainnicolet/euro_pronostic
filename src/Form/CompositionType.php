<?php

namespace App\Form;

use App\Entity\Composition;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompositionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('team_1', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'name',
                'choice_value' => 'id',
                'label' => 'Equipe 1'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Composition::class,
        ]);
    }
}
