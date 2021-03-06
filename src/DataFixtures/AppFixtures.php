<?php

namespace App\DataFixtures;

use App\Entity\Game;
use App\Entity\Team;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
  /**
   * @var UserPasswordEncoderInterface
   */
  private $encoder;

  private $manager;

  /**
   * UserFixtures constructor.
   * @param UserPasswordEncoderInterface $encoder
   */
  public function __construct(UserPasswordEncoderInterface $encoder) {

    $this->encoder = $encoder;
  }

  public function load(ObjectManager $manager)
  {
    $this->manager = $manager;

    $this->createUser('admin', 'admin', ['ROLE_ADMIN']);
    $this->createUser('demo', 'demo', ['ROLE_USER']);
    $this->createTeams();
    $manager->flush();

    $this->createGames();
    $manager->flush();
  }

  private function createUser($username, $password, $roles) {
    $user = new User();
    $user->setUsername($username)->setPassword($this->encoder->encodePassword($user, $password))->setRoles($roles);
    $this->manager->persist($user);
  }

  private function createTeams() {
    $this->createTeam('Italie', 1, "ð®ð¹");
    $this->createTeam('Suisse', 1, "ð¨ð­");
    $this->createTeam('Turquie', 1, "ð¹ð·");
    $this->createTeam('Pays de Galles', 1, "ð´ó §ó ¢ó ·ó ¬ó ³ó ¿");

    $this->createTeam('Belgique', 2, "ð§ðª");
    $this->createTeam('Danemark', 2, "ð©ð°");
    $this->createTeam('Finlande', 2, "ð«ð®");
    $this->createTeam('Russie', 2, "ð·ðº");

    $this->createTeam('Autriche', 3, "ð¦ð¹");
    $this->createTeam('Pays-Bas', 3, "ð³ð±");
    $this->createTeam('MacÃ©doine du Nord', 3, "ð²ð°");
    $this->createTeam('Ukraine', 3, "ðºð¦");

    $this->createTeam('Croatie', 4, "ð­ð·");
    $this->createTeam('RÃ©publique tchÃ¨que', 4, "ð¨ð¿");
    $this->createTeam('Angleterre', 4, "ð´ó §ó ¢ó ¥ó ®ó §ó ¿");
    $this->createTeam('Ecosse', 4, "ð´ó §ó ¢ó ³ó £ó ´ó ¿");

    $this->createTeam('Pologne', 5, "ðµð±");
    $this->createTeam('Slovaquie', 5, "ð¸ð°");
    $this->createTeam('Espagne', 5, "ðªð¸");
    $this->createTeam('SuÃ¨de', 5, "ð¸ðª");

    $this->createTeam('France', 6, "ð«ð·");
    $this->createTeam('Allemagne', 6, "ð©ðª");
    $this->createTeam('Hongrie', 6, "ð­ðº");
    $this->createTeam('Portugal', 6, "ðµð¹");
  }

  private function createTeam($name, $group, $flag) {
    $team = new Team();
    $team->setName($name)->setGroupe($group)->setFlag($flag);
    $this->manager->persist($team);
  }

  private function createGames() {

    // vendredi 11 juin 2021
    $this->createGame("Turquie", "Italie", 11, 6, 2021, 21, 00, true, 'Poules');

    // samedi 12 juin 2021
    $this->createGame("Pays de Galles", "Suisse", 12, 6, 2021, 15, 00, true, 'Poules');
    $this->createGame("Danemark", "Finlande", 12, 6, 2021, 18, 00, true, 'Poules');
    $this->createGame("Belgique", "Russie", 12, 6, 2021, 21, 00, true, 'Poules');

    // dimanche 13 juin 2021
    $this->createGame("Angleterre", "Croatie", 13, 6, 2021, 15, 00, true, 'Poules');
    $this->createGame("Autriche", "MacÃ©doine du Nord", 13, 6, 2021, 18, 00, true, 'Poules');
    $this->createGame("Pays-Bas", "Ukraine", 13, 6, 2021, 21, 00, true, 'Poules');

    // lundi 14 juin 2021
    $this->createGame("Ecosse", "RÃ©publique tchÃ¨que", 14, 6, 2021, 15, 00, true, 'Poules');
    $this->createGame("Pologne", "Slovaquie", 14, 6, 2021, 18, 00, true, 'Poules');
    $this->createGame("Espagne", "SuÃ¨de", 14, 6, 2021, 21, 00, true, 'Poules');

    // mardi 15 juin 2021
    $this->createGame("Hongrie", "Portugal", 15, 6, 2021, 18, 00, true, 'Poules');
    $this->createGame("France", "Allemagne", 15, 6, 2021, 21, 00, true, 'Poules');

    // mercredi 16 juin 2021
    $this->createGame("Finlande", "Russie", 16, 6, 2021, 15, 00, true, 'Poules');
    $this->createGame("Turquie", "Pays de Galles", 16, 6, 2021, 18, 00, true, 'Poules');
    $this->createGame("Italie", "Suisse", 16, 6, 2021, 21, 00, true, 'Poules');

    // jeudi 17 juin 2021
    $this->createGame("Ukraine", "MacÃ©doine du Nord", 17, 6, 2021, 15, 00, true, 'Poules');
    $this->createGame("Danemark", "Belgique", 17, 6, 2021, 18, 00, true, 'Poules');
    $this->createGame("Pays-Bas", "Autriche", 17, 6, 2021, 21, 00, true, 'Poules');

    // vendredi 18 juin 2021
    $this->createGame("SuÃ¨de", "Slovaquie", 18, 6, 2021, 15, 00, true, 'Poules');
    $this->createGame("Croatie", "RÃ©publique tchÃ¨que", 18, 6, 2021, 18, 00, true, 'Poules');
    $this->createGame("Angleterre", "Ecosse", 18, 6, 2021, 21, 00, true, 'Poules');

    // samedi 19 juin 2021
    $this->createGame("Hongrie", "France", 19, 6, 2021, 15, 00, true, 'Poules');
    $this->createGame("Portugal", "Allemagne", 19, 6, 2021, 18, 00, true, 'Poules');
    $this->createGame("Espagne", "Pologne", 19, 6, 2021, 21, 00, true, 'Poules');

    // dimanche 20 juin 2021
    $this->createGame("Italie", "Pays de Galles", 20, 6, 2021, 18, 00, true, 'Poules');
    $this->createGame("Suisse", "Turquie", 20, 6, 2021, 18, 00, true, 'Poules');

    // lundi 21 juin 2021
    $this->createGame("Ukraine", "Autriche", 21, 6, 2021, 18, 00, true, 'Poules');
    $this->createGame("MacÃ©doine du Nord", "Pays-Bas", 21, 6, 2021, 18, 00, true, 'Poules');
    $this->createGame("Russie", "Danemark", 21, 6, 2021, 21, 00, true, 'Poules');
    $this->createGame("Finlande", "Belgique", 21, 6, 2021, 21, 00, true, 'Poules');

    // mardi 22 juin 2021
    $this->createGame("RÃ©publique tchÃ¨que", "Angleterre", 22, 6, 2021, 21, 00, true, 'Poules');
    $this->createGame("Croatie", "Ecosse", 22, 6, 2021, 21, 00, true, 'Poules');

    // mercredi 23 juin 2021
    $this->createGame("SuÃ¨de", "Pologne", 23, 6, 2021, 18, 00, true, 'Poules');
    $this->createGame("Slovaquie", "Espagne", 23, 6, 2021, 18, 00, true, 'Poules');
    $this->createGame("Portugal", "France", 23, 6, 2021, 21, 00, true, 'Poules');
    $this->createGame("Allemagne", "Hongrie", 23, 6, 2021, 21, 00, true, 'Poules');

    // samedi 26 juin 2021
    $this->createGame(null, null, 26, 6, 2021, 18, 00, false, '1/8');
    $this->createGame(null, null, 26, 6, 2021, 21, 00, false, '1/8');

    // dimanche 27 juin 2021
    $this->createGame(null, null, 27, 6, 2021, 18, 00, false, '1/8');
    $this->createGame(null, null, 27, 6, 2021, 21, 00, false, '1/8');

    // lundi 28 juin 2021
    $this->createGame(null, null, 28, 6, 2021, 18, 00, false, '1/8');
    $this->createGame(null, null, 28, 6, 2021, 21, 00, false, '1/8');

    // mardi 29 juin 2021
    $this->createGame(null, null, 29, 6, 2021, 18, 00, false, '1/8');
    $this->createGame(null, null, 29, 6, 2021, 21, 00, false, '1/8');

    // vendredi 2 juillet 2021
    $this->createGame(null, null, 2, 7, 2021, 18, 00, false, '1/4');
    $this->createGame(null, null, 2, 7, 2021, 21, 00, false, '1/4');


    // samedi 3 juillet 2021
    $this->createGame(null, null, 3, 7, 2021, 18, 00, false, '1/4');
    $this->createGame(null, null, 3, 7, 2021, 21, 00, false, '1/4');


    // mardi 6 juillet 2021
    $this->createGame(null, null, 6, 7, 2021, 21, 00, false, '1/2');

    // mercredi 7 juillet 2021
    $this->createGame(null, null, 7, 7, 2021, 21, 00, false, '1/2');

    // dimanche 11 juillet 2021
    $this->createGame(null, null, 11, 7, 2021, 21, 00, false, 'Finale');
  }

  private function createGame($team_1, $team_2, $day, $month, $year, $hour, $minute, $isGroupGame, $phase) {

    // Date & Time
    $dateOutput = new \DateTime();
    $dateOutput->setDate($year, $month, $day);
    $dateOutput->setTime($hour, $minute);

    // Teams
    $team1_Output = $this->manager->getRepository(Team::class)->findOneBy(['name' => $team_1]);
    $team2_Output = $this->manager->getRepository(Team::class)->findOneBy(['name' => $team_2]);

    $game = new Game();
    $game->setTeam1($team1_Output)->setTeam2($team2_Output);
    $game->setDate($dateOutput)->setTime($dateOutput)->setIsGroupGame($isGroupGame)->setPhase($phase)->setIsFinished(false);
    $this->manager->persist($game);
  }
}
