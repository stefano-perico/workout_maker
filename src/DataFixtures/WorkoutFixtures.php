<?php

namespace App\DataFixtures;

use Doctrine\Common\Persistence\ObjectManager;

class WorkoutFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
