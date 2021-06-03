<?php

namespace App\Form;

use App\Entity\Composition;
use App\Entity\Team;
use App\Repository\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompositionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      for ($i = 1; $i <= 8; $i++) {
        $builder
            ->add('team_' . $i, EntityType::class, [
                'class' => Team::class,
                'query_builder'=>function(TeamRepository $teams){
                  return $teams ->createQueryBuilder('t')->orderBy('t.name','ASC');},
                'choice_label' => 'name',
                'choice_value' => 'id',
                'label' => 'Equipe ' . $i
            ])
        ;
      }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Composition::class,
        ]);
    }
}
