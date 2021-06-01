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

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

      // Set user
      $composition->setPlayer($user);

      $this->em->persist($composition);
      $this->em->flush();
      return $this->redirectToRoute('user.index');
    }

    return $this->render('/user/composition/create.html.twig', [
//        'composition' => $composition,
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

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

      $this->em->flush();
      return $this->redirectToRoute('user.index');
    }

    return $this->render('/user/composition/edit.html.twig', [
        'form' => $form->createView()
    ]);
  }
}
