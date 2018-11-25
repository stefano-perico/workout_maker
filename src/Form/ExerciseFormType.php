<?php

namespace App\Form;

use App\Entity\Exercise;
use App\Entity\ExercisesList;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExerciseFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reps')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('workout')
            ->add('exerciseName', EntityType::class, [
                'class' => ExercisesList::class,
                'choice_label'  =>  'exerciseName',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Exercise::class,
        ]);
    }
}
