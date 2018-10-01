<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixture
{
    private $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        $adminUser = new User();
        $adminUser
            ->setEmail('admin@example.com')
            ->setPassword($this->userPasswordEncoder->encodePassword($adminUser,'test'))
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($adminUser);

        $this->createMany(User::class, 10, function (User $user, $count) {
           $user->setEmail(sprintf('workout%d@example.com', $count));
           $user->setPassword($this->userPasswordEncoder->encodePassword($user,'test'));

        });

        $manager->flush();
    }
}
