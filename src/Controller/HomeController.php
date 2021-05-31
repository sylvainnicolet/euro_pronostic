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
    $user = $this->getUser();
    if ($user != null) {
        if (in_array("ROLE_ADMIN", $user->getRoles())) {
            return $this->redirectToRoute('admin.index');
        }
      if (in_array("ROLE_USER", $user->getRoles())) {
        return $this->redirectToRoute('user.index');
      }
    }
    return $this->redirectToRoute('login');
  }

  /**
   * @Route("/admin/", name="admin.index")
   * @return Response
   */
  public function indexAdmin(): Response
  {
    return $this->render('admin/index.html.twig');
  }

  /**
   * @Route("/user/", name="user.index")
   * @return Response
   */
  public function indexUser(): Response
  {
    return $this->render('user/index.html.twig', [
        'user' => $this->getUser()
    ]);
  }
}
