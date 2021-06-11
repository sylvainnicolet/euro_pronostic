<?php

namespace App\Controller;

use App\Entity\Composition;
use App\Entity\User;
use App\Form\CompositionType;
use App\Form\UserType;
use App\Repository\CompositionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CompositionController extends AbstractController
{
  /**
   * @var CompositionRepository
   */
  private $repository;
  /**
   * @var EntityManagerInterface
   */
  private $em;

  /**
   * AdminPropertyController constructor.
   * @param CompositionRepository $repository
   * @param EntityManagerInterface $em
   */
  public function __construct(CompositionRepository $repository, EntityManagerInterface $em)
  {

    $this->repository = $repository;
    $this->em = $em;
  }

  /**
   * @Route("/user/composition/create/{id}", name="user.composition.create")
   * @param User $user
   * @param Request $request
   * @return RedirectResponse|Response
   */
  public function new(User $user, Request $request)
  {
    $composition = new Composition();
    $form = $this->createForm(CompositionType::class, $composition);

    $endDate = new \DateTime();
    $endDate->setDate(2020,6,11)->setTime(18,00);
    $currentDate = new \DateTime();

    $hasStarted = false;

    if ($currentDate >= $endDate) {
      $hasStarted = true;
    }

    if ($hasStarted) {
      return $this->redirectToRoute('user.show', [
          'id' => $user->getId(),
          'slug' => $user->getSlug()
      ]);
    }

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

      // Set user
      $composition->setPlayer($user);

      // Validation
      if ($this->isTeamDuplicated($composition)) {
        return $this->render('/user/composition/create.html.twig', [
            'form' => $form->createView(),
            'error_message' => 'Tu ne peux pas choisir plusieurs fois la même équipe !'
        ]);
      }

      $this->em->persist($composition);
      $this->em->flush();
      return $this->redirectToRoute('user.index');
    }

    return $this->render('/user/composition/create.html.twig', [
        'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/user/composition/edit/{id}", name="user.composition.edit", methods={"GET|POST"})
   * @param Composition $composition
   * @param Request $request
   * @return RedirectResponse|Response
   */
  public function edit(Composition $composition, Request $request) {

    $form = $this->createForm(CompositionType::class, $composition);
    $user = $this->getUser();

    $endDate = new \DateTime();
    $endDate->setDate(2020,6,11)->setTime(18,00);
    $currentDate = new \DateTime();

    $hasStarted = false;

    if ($currentDate >= $endDate) {
      $hasStarted = true;
    }

    if ($hasStarted) {
      return $this->redirectToRoute('user.show', [
          'id' => $user->getId(),
          'slug' => $user->getSlug()
      ]);
    }

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

      // Validation
      if ($this->isTeamDuplicated($composition)) {
        return $this->render('/user/composition/edit.html.twig', [
            'form' => $form->createView(),
            'error_message' => 'Tu ne peux pas choisir plusieurs fois la même équipe !'
        ]);
      }

      $this->em->flush();
      return $this->redirectToRoute('user.index');
    }

    return $this->render('/user/composition/edit.html.twig', [
        'form' => $form->createView()
    ]);
  }

  private function isTeamDuplicated($composition) {
    $teams = [
        $composition->getTeam1()->getName(),
        $composition->getTeam2()->getName(),
        $composition->getTeam3()->getName(),
        $composition->getTeam4()->getName(),
        $composition->getTeam5()->getName(),
        $composition->getTeam6()->getName(),
        $composition->getTeam7()->getName(),
        $composition->getTeam8()->getName(),
    ];

    return count($teams) !== count(array_unique($teams));
  }
}
