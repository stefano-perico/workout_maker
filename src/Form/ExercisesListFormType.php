<?php

namespace App\Form;

use App\Entity\ExercisesList;
use App\Entity\MuscleGroup;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExercisesListFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('exercise', TextType::class)
            ->add('description')
            ->add('publishedAt', DateType::class)
            ->add('muscleGroup', EntityType::class, [
                'class'         =>  MuscleGroup::class,
                'choice_label'  =>  'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ExercisesList::class,
        ]);
    }
}
