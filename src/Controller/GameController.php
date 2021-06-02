<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Repository\GameRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class GameController extends AbstractController
{
  /**
   * @var GameRepository
   */
  private $repository;
  /**
   * @var EntityManagerInterface
   */
  private $em;

  /**
   * AdminPropertyController constructor.
   * @param GameRepository $repository
   * @param EntityManagerInterface $em
   */
  public function __construct(GameRepository $repository, EntityManagerInterface $em) {

    $this->repository = $repository;
    $this->em = $em;
  }

  /**
   * @Route("/admin/games", name="admin.games")
   * @return Response
   */
  public function showGames(): Response
  {
    $games = $this->getDoctrine()->getRepository(Game::class)->findAll();
//    dd($games);

    return $this->render('admin/games/index.html.twig', [
        'games' => $games
    ]);
  }

  /**
   * @Route("/admin/games/create", name="admin.games.create")
   * @param Request $request
   * @return RedirectResponse|Response
   */
  public function new(Request $request)
  {
    $game = new Game();
    $form = $this->createForm(GameType::class, $game);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

      $this->em->persist($game);
      $this->em->flush();

      return $this->redirectToRoute('admin.games');
    }

    return $this->render('/admin/games/create.html.twig', [
        'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/admin/games/edit/{id}", name="admin.games.edit", methods={"GET|POST"})
   * @param Game $game
   * @param Request $request
   * @return RedirectResponse|Response
   */
  public function edit(Game $game, Request $request) {

    $form = $this->createForm(GameType::class, $game);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

      $this->em->flush();
      return $this->redirectToRoute('admin.games');
    }

    return $this->render('/admin/games/edit.html.twig', [
        'form' => $form->createView()
    ]);
  }

  /**
   * @Route("admin/games/delete/{id}", name="admin.games.delete", methods={"DELETE"})
   * @param Game $game
   * @param Request $request
   * @return RedirectResponse
   */
  public function deleteUser(Game $game, Request $request) {
    if ($this->isCsrfTokenValid('delete' . $game->getId(), $request->get('_token'))) {
      $this->em->remove($game);
      $this->em->flush();
    }

    return $this->redirectToRoute('admin.games');
  }
}
