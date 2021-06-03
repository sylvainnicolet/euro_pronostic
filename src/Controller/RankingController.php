<?php

namespace App\Controller;

use App\Entity\Composition;
use App\Entity\Game;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RankingController extends AbstractController
{
  /**
   * @Route("/user/ranking", name="user.ranking")
   * @return Response
   */
  public function index(): Response
  {
    $allUsers = $this->getDoctrine()->getRepository(User::class)->findAll();
    $users = [];

    // Get only users with role_user
    foreach ($allUsers as $user) {
      if (in_array("ROLE_USER", $user->getRoles())) {
        array_push($users, $user);
      }
    }

    foreach ($users as $user) {
      $composition = $this->getDoctrine()->getRepository(Composition::class)->findOneBy([
          'player' => $user->getId()
      ]);
      $gamesPlayed = $this->getDoctrine()->getRepository(Game::class)->findBy(['isFinished' => true,]);

      if ($composition != null) {
        $team1 = $this->calculatePoints($composition->getTeam1(), $gamesPlayed, 8);
        $team2 = $this->calculatePoints($composition->getTeam2(), $gamesPlayed, 7);
        $team3 = $this->calculatePoints($composition->getTeam3(), $gamesPlayed, 6);
        $team4 = $this->calculatePoints($composition->getTeam4(), $gamesPlayed, 5);
        $team5 = $this->calculatePoints($composition->getTeam5(), $gamesPlayed, 4);
        $team6 = $this->calculatePoints($composition->getTeam6(), $gamesPlayed, 3);
        $team7 = $this->calculatePoints($composition->getTeam7(), $gamesPlayed, 2);
        $team8 = $this->calculatePoints($composition->getTeam8(), $gamesPlayed, 1);
        $user->getComposition()->total = $team1 + $team2 + $team3 + $team4 + $team5 + $team6 + $team7 + $team8;
      }

    }

    return $this->render('user/ranking/index.html.twig', [
        'title' => 'Classement général',
        'users' => $users
    ]);
  }

  /**
   * @Route("/user/ranking-league", name="user.ranking-league")
   * @return Response
   */
  public function indexLeague(): Response
  {
    $user = $this->getUser();

    $users = $this->getDoctrine()->getRepository(User::class)->findBy([
        'league' => $user->getLeague()
    ]);

    foreach ($users as $user) {
      $composition = $this->getDoctrine()->getRepository(Composition::class)->findOneBy([
          'player' => $user->getId()
      ]);
      $gamesPlayed = $this->getDoctrine()->getRepository(Game::class)->findBy(['isFinished' => true,]);

      if ($composition != null) {
        $team1 = $this->calculatePoints($composition->getTeam1(), $gamesPlayed, 8);
        $team2 = $this->calculatePoints($composition->getTeam2(), $gamesPlayed, 7);
        $team3 = $this->calculatePoints($composition->getTeam3(), $gamesPlayed, 6);
        $team4 = $this->calculatePoints($composition->getTeam4(), $gamesPlayed, 5);
        $team5 = $this->calculatePoints($composition->getTeam5(), $gamesPlayed, 4);
        $team6 = $this->calculatePoints($composition->getTeam6(), $gamesPlayed, 3);
        $team7 = $this->calculatePoints($composition->getTeam7(), $gamesPlayed, 2);
        $team8 = $this->calculatePoints($composition->getTeam8(), $gamesPlayed, 1);
        $user->getComposition()->total = $team1 + $team2 + $team3 + $team4 + $team5 + $team6 + $team7 + $team8;
      }

    }

    return $this->render('user/ranking/index.html.twig', [
        'title' => 'Classement de ma ligue',
        'users' => $users
    ]);
  }

  private function calculatePoints($team, $gamesPlayed, $coeff) {
    $mj = 0;
    $g = 0;
    $n = 0;
    $p = 0;

    foreach ($gamesPlayed as $game) {

      // Si équipe 1
      if ($game->getTeam1()->getName() == $team->getName()) {
        $mj = $mj + 1;

        // Null
        if ($game->getScore1() > $game->getScore2()) {
          $g = $g + 1;
        }
        elseif ($game->getScore1() == $game->getScore2()) {
          $n = $n +1;
        }
        else {
          $p = $p +1;
        }
      }

      // Si équipe 2
      if ($game->getTeam2()->getName() == $team->getName()) {
        $mj = $mj + 1;

        // Null
        if ($game->getScore2() > $game->getScore1()) {
          $g = $g + 1;
        }
        elseif ($game->getScore2() == $game->getScore1()) {
          $n = $n +1;
        }
        else {
          $p = $p +1;
        }
      }
    }

    return ($g * $coeff) + ($n * ($coeff/2));
  }
}
