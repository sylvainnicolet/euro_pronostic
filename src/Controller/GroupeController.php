<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupeController extends AbstractController
{
  /**
   * @Route("/user/groupes", name="user.groupes")
   * @return Response
   */
  public function index(): Response
  {
    $teams = $this->getDoctrine()->getRepository(Team::class)->findAll();
    $gamesPlayed = $this->getDoctrine()->getRepository(Game::class)->findBy([
      'isFinished' => true,
      'isGroupGame' => true
    ]);

    $groupes = ['A', 'B', 'C', 'D', 'E', 'F'];
    $groupesOutput = [];

    for ($i = 0; $i < count($groupes); $i++) {

      foreach ($teams as $key => $team) {

        // Game played
        $calculatedPoints = $this->calculatePoints($team, $gamesPlayed);
        $team->mj = $calculatedPoints['mj'];
        $team->g = $calculatedPoints['g'];
        $team->n = $calculatedPoints['n'];
        $team->p = $calculatedPoints['p'];
        $team->total = $calculatedPoints['total'];

        if ($team->getGroupe() == $i + 1) {
          $groupesOutput['Groupe ' . $groupes[$i]][$key] = $team;
        }
      }
    }

//    dd($groupesOutput);

    return $this->render('user/groupes/index.html.twig', [
        'groupes' => $groupesOutput
    ]);
  }

  private function calculatePoints($team, $gamesPlayed) {
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

    $total = ($g * 3) + ($n * 1);

    return [
        'mj' => $mj,
        'g' => $g,
        'n' => $n,
        'p' => $p,
        'total' => $total
    ];
  }
}
