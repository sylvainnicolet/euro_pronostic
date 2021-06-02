<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
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
            ->add('team_2', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'name',
                'choice_value' => 'id',
                'label' => 'Equipe 2'
            ])
            ->add('score_1')
            ->add('score_2')
            ->add('isGroupGame', CheckboxType::class, [
                'label' => 'Match de groupe',
                'required' => false
            ])
            ->add('isFinished', CheckboxType::class, [
                'label' => 'Terminé',
                'required' => false
            ])
            ->add('date', DateType::class, [
                'format' => 'ddMMyyyy'
            ])
            ->add('time', TimeType::class, [

            ])
            ->add('phase')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
