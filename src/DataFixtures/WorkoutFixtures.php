<?php

namespace App\DataFixtures;

use App\Entity\Difficulty;
use App\Entity\Exercice;
use App\Entity\Workout;
use Doctrine\Common\Persistence\ObjectManager;

class WorkoutFixtures extends BaseFixture
{
    private static $workoutName = [
        'Fran',
        'Marie',
        'Alice',
    ];

    private static $exerciceCategory = [
        'Trunk',
        'Arms',
        'Lower body',
        'Whole body',
    ];

    private static $difficultyLevel = [
        '1',
        '2',
        '3',
    ];

    protected function loadData(ObjectManager $manager)
    {


        $this->createMany(Workout::class, 10, function (Workout $workout, $count) use ($manager) {
            $difficulty1 =  new Difficulty();
            $difficulty1->setLevel($this->faker->randomElement(self::$difficultyLevel));
            $manager->persist($difficulty1);

            $workout
                ->setName($this->faker->randomElement(self::$workoutName))
                ->setDifficulty($difficulty1)
                ->setCategory($this->faker->randomElement(self::$exerciceCategory))
                ->setDescription(
                    'Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
                                laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,
                                capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing
                                picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt
                                occaecat lorem meatball prosciutto quis strip steak.'
                )
            ;

            if ($this->faker->boolean(70)){
                $workout->setPublishedAt($this->faker->dateTimeBetween('-100 days', '-1 days'));
            }
        });

        $manager->flush();
    }
}
