<?php

namespace App\Controller;

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
    $groupes = ['A', 'B', 'C', 'D', 'E', 'F'];
    $groupesOutput = [];

    for ($i = 0; $i < count($groupes); $i++) {

      foreach ($teams as $key => $team) {
        if ($team->getGroupe() == $i + 1) {
          $groupesOutput['Groupe ' . $groupes[$i]][$key] = $team;
        }
      }
    }

    return $this->render('user/groupes/index.html.twig', [
        'groupes' => $groupesOutput
    ]);
  }
}
