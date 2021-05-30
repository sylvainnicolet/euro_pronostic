<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
  /**
   * @Route("/", name="home")
   * @return Response
   */
  public function index(): Response
  {
    return $this->redirectToRoute('admin.home');
  }

  /**
   * @Route("/admin/", name="admin.home")
   * @return Response
   */
  public function indexAdmin(): Response
  {
    return $this->render('admin/index.html.twig');
  }

  /**
   * @Route("/user/", name="user.home")
   * @return Response
   */
  public function indexUser(): Response
  {
    return $this->render('user/index.html.twig');
  }
}
