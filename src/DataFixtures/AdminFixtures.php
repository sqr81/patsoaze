<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures extends Fixture
{
    private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
        $Admin1 =new Admin();
        $Admin1 ->setUsername("Yann");
        $Admin1->setPassword($this->passwordEncoder->encodePassword(
            $Admin1,
            'patsoaze'
        ));
        $Admin1->setRoles(['ROLE_ADMIN']);
        $manager->persist($Admin1);

        $Admin2 =new Admin();
        $Admin2 ->setUsername("Pat");
        $Admin2->setPassword($this->passwordEncoder->encodePassword(
            $Admin2,
            'patsoaze'
        ));
        $Admin2->setRoles(['ROLE_ADMIN']);
        $manager->persist($Admin2);

        $Admin3 =new Admin();
        $Admin3 ->setUsername("Soaze");
        $Admin3->setPassword($this->passwordEncoder->encodePassword(
            $Admin3,
            'patsoaze'
        ));
        $Admin3->setRoles(['ROLE_ADMIN']);
        $manager->persist($Admin3);

        $manager->flush();
    }
}
