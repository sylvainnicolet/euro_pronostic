<?php

namespace App\Controller;

use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RulesController extends AbstractController
{
  /**
   * @Route("/user/rules", name="user.rules")
   * @return Response
   */
  public function index(): Response
  {
    return $this->render('user/rules/index.html.twig');
  }
}
