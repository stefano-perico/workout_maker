<?php

namespace App\DataFixtures;

use App\Entity\Exercice;
use Doctrine\Common\Persistence\ObjectManager;

class ExerciceFixture extends BaseFixture
{
    private static $exerciceName = [
        'Squat',
        'Burpees',
        'Situps',
        'Pullups',
    ];

    private static $exerciceCategory = [
        'Trunk',
        'Arms',
        'lower body',
        'whole body',
    ];

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Exercice::class, 10, function (Exercice $exercice, $count) {
            $exercice
                ->setName($this->faker->randomElement(self::$exerciceName))
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
                $exercice->setPublishedAt($this->faker->dateTimeBetween('-100 days', '-1 days'));
            }
        });

        $manager->flush();
    }
}
