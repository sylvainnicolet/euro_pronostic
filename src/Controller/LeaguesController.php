<?php

namespace App\Controller;

use App\Entity\League;
use App\Form\LeagueType;
use App\Repository\LeagueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LeaguesController extends AbstractController
{
  /**
   * @var LeagueRepository
   */
  private $repository;
  /**
   * @var EntityManagerInterface
   */
  private $em;

  /**
   * AdminPropertyController constructor.
   * @param LeagueRepository $repository
   * @param EntityManagerInterface $em
   */
  public function __construct(LeagueRepository $repository, EntityManagerInterface $em) {

    $this->repository = $repository;
    $this->em = $em;
  }

  /**
   * @Route("/admin/leagues", name="admin.leagues")
   * @return Response
   */
  public function show(): Response
  {
    $leagues = $this->getDoctrine()->getRepository(League::class)->findAll();

    return $this->render('admin/leagues/index.html.twig', [
        'leagues' => $leagues
    ]);
  }

  /**
   * @Route("/admin/leagues/create", name="admin.leagues.create")
   * @param Request $request
   * @return RedirectResponse|Response
   */
  public function new(Request $request)
  {
    $league = new League();
    $form = $this->createForm(LeagueType::class, $league);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

      $this->em->persist($league);
      $this->em->flush();

      return $this->redirectToRoute('admin.leagues');
    }

    return $this->render('/admin/leagues/create.html.twig', [
        'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/admin/leagues/edit/{id}", name="admin.leagues.edit", methods={"GET|POST"})
   * @param League $league
   * @param Request $request
   * @return RedirectResponse|Response
   */
  public function edit(League $league, Request $request) {

    $form = $this->createForm(LeagueType::class, $league);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

      $this->em->flush();
      return $this->redirectToRoute('admin.leagues');
    }

    return $this->render('/admin/leagues/edit.html.twig', [
        'form' => $form->createView()
    ]);
  }

  /**
   * @Route("admin/leagues/delete/{id}", name="admin.leagues.delete", methods={"DELETE"})
   * @param League $league
   * @param Request $request
   * @return RedirectResponse
   */
  public function deleteUser(League $league, Request $request) {
    if ($this->isCsrfTokenValid('delete' . $league->getId(), $request->get('_token'))) {
      $this->em->remove($league);
      $this->em->flush();
    }

    return $this->redirectToRoute('admin.leagues');
  }
}
