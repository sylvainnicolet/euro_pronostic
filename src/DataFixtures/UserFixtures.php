<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
  /**
   * @var UserPasswordEncoderInterface
   */
  private $encoder;

  /**
   * UserFixtures constructor.
   * @param UserPasswordEncoderInterface $encoder
   */
  public function __construct(UserPasswordEncoderInterface $encoder) {

    $this->encoder = $encoder;
  }

  /**
   * @param ObjectManager $manager
   */
  public function load(ObjectManager $manager)
  {
    $userAdmin = new User();
    $userAdmin->setUsername('admin');
    $userAdmin->setPassword($this->encoder->encodePassword($userAdmin, 'admin'));
    $userAdmin->setRoles(['ROLE_ADMIN']);
    $manager->persist($userAdmin);

    $user = new User();
    $user->setUsername('user');
    $user->setPassword($this->encoder->encodePassword($userAdmin, 'user'));
    $user->setRoles(['ROLE_USER']);
    $manager->persist($user);

    $manager->flush();
  }
}
