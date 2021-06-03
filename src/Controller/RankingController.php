<?php

namespace App\Controller;

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

    return $this->render('user/ranking/index.html.twig', [
        'title' => 'Classement de ma ligue',
        'users' => $users
    ]);
  }
}
