<?php

namespace App\DataFixtures;


use App\Entity\ExercisesList;

use Doctrine\Common\Persistence\ObjectManager;

class ExerciseFixture extends BaseFixture
{
    private static $exerciseName = [
        'Squat',
        'Burpees',
        'Situps',
        'Pullups',
    ];

    private static $exerciseCategory = [
        'Trunk',
        'Arms',
        'Lower body',
        'Whole body',
    ];

    protected function loadData(ObjectManager $manager)
    {

        $this->createMany(ExercisesList::class, 4, function (ExercisesList $exercise, $count) {
            $exercise
                ->setExercise($this->faker->randomElement(self::$exerciseName))
                ->setDifficulty($this->faker->numberBetween(1, 3))
                ->setDescription(
                    'Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
                                laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,
                                capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing
                                picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt
                                occaecat lorem meatball prosciutto quis strip steak.'
                )
            ;

            if ($this->faker->boolean(70)){
                $exercise->setPublishedAt($this->faker->dateTimeBetween('-100 days', '-1 days'));
            }
        });

        $manager->flush();

    }

}
