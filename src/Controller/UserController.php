<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
  /**
   * @Route("/admin/users", name="admin.users")
   * @return Response
   */
  public function showUsers(): Response
  {
    $users = $this->getDoctrine()->getRepository(User::class)->findAll();

    return $this->render('admin/users/index.html.twig', [
        'users' => $users
    ]);
  }
}
