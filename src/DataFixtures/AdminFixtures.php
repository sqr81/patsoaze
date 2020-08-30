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

        $manager->flush();
    }
}
