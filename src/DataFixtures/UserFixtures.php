<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user
            ->setUsername('usuario')
            ->setPassword('$argon2i$v=19$m=65536,t=4,p=1$M3p1T2pPamM2dDRPRWRQZQ$lBtgad+jvDxiSLSLwIOOfmkUS4hmoJLGMxDspf4gBko');

        $manager->persist($user);

        $manager->flush();
    }
}
