<?php

namespace App\Controller;

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
    return $this->render('admin/index.html.twig');
  }
}
