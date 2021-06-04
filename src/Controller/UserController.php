<?php

namespace App\Controller;

use App\Entity\Composition;
use App\Entity\Game;
use App\Entity\User;
use App\Form\UserPasswordType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
  /**
   * @var UserRepository
   */
  private $repository;
  /**
   * @var EntityManagerInterface
   */
  private $em;

  /**
   * AdminPropertyController constructor.
   * @param UserRepository $repository
   * @param EntityManagerInterface $em
   */
  public function __construct(UserRepository $repository, EntityManagerInterface $em) {

    $this->repository = $repository;
    $this->em = $em;
  }

  /**
   * @Route("/admin/users", name="admin.users")
   * @return Response
   */
  public function index(): Response
  {
    $users = $this->getDoctrine()->getRepository(User::class)->findAll();

    return $this->render('admin/users/index.html.twig', [
        'users' => $users
    ]);
  }

  /**
   * @Route("/user/{slug}-{id}", name="user.show", requirements={"slug": "[a-z0-9\-]*"})
   * @param User $user
   * @param string $slug
   * @return Response
   */
  public function show(User $user, string $slug): Response
  {
    if ($user->getSlug() !== $slug) {
      return $this->redirectToRoute('user.show', [
          'id' => $user->getId(),
          'slug' => $user->getSlug()
      ], 301);
    }

    $endDate = new \DateTime();
    $endDate->setDate(2021,6,11)->setTime(18,00);
    $currentDate = new \DateTime();

    $hasStarted = false;

    if ($currentDate >= $endDate) {
      $hasStarted = true;
    }

    $composition = $this->getDoctrine()->getRepository(Composition::class)->findOneBy([
        'player' => $user->getId()
    ]);

    if ($composition != null) {
      $gamesPlayed = $this->getDoctrine()->getRepository(Game::class)->findBy(['isFinished' => true,]);

      // Team 1
      $calculatedPoints = $this->calculatePoints($composition->getTeam1(), $gamesPlayed, 8);
      $composition->getTeam1()->mj = $calculatedPoints['mj'];
      $composition->getTeam1()->g = $calculatedPoints['g'];
      $composition->getTeam1()->n = $calculatedPoints['n'];
      $composition->getTeam1()->p = $calculatedPoints['p'];
      $composition->getTeam1()->total = $calculatedPoints['total'];

      // Team 2
      $calculatedPoints = $this->calculatePoints($composition->getTeam2(), $gamesPlayed, 7);
      $composition->getTeam2()->mj = $calculatedPoints['mj'];
      $composition->getTeam2()->g = $calculatedPoints['g'];
      $composition->getTeam2()->n = $calculatedPoints['n'];
      $composition->getTeam2()->p = $calculatedPoints['p'];
      $composition->getTeam2()->total = $calculatedPoints['total'];

      // Team 3
      $calculatedPoints = $this->calculatePoints($composition->getTeam3(), $gamesPlayed, 6);
      $composition->getTeam3()->mj = $calculatedPoints['mj'];
      $composition->getTeam3()->g = $calculatedPoints['g'];
      $composition->getTeam3()->n = $calculatedPoints['n'];
      $composition->getTeam3()->p = $calculatedPoints['p'];
      $composition->getTeam3()->total = $calculatedPoints['total'];

      // Team 4
      $calculatedPoints = $this->calculatePoints($composition->getTeam4(), $gamesPlayed, 5);
      $composition->getTeam4()->mj = $calculatedPoints['mj'];
      $composition->getTeam4()->g = $calculatedPoints['g'];
      $composition->getTeam4()->n = $calculatedPoints['n'];
      $composition->getTeam4()->p = $calculatedPoints['p'];
      $composition->getTeam4()->total = $calculatedPoints['total'];

      // Team 5
      $calculatedPoints = $this->calculatePoints($composition->getTeam5(), $gamesPlayed,4);
      $composition->getTeam5()->mj = $calculatedPoints['mj'];
      $composition->getTeam5()->g = $calculatedPoints['g'];
      $composition->getTeam5()->n = $calculatedPoints['n'];
      $composition->getTeam5()->p = $calculatedPoints['p'];
      $composition->getTeam5()->total = $calculatedPoints['total'];

      // Team 6
      $calculatedPoints = $this->calculatePoints($composition->getTeam6(), $gamesPlayed,3);
      $composition->getTeam6()->mj = $calculatedPoints['mj'];
      $composition->getTeam6()->g = $calculatedPoints['g'];
      $composition->getTeam6()->n = $calculatedPoints['n'];
      $composition->getTeam6()->p = $calculatedPoints['p'];
      $composition->getTeam6()->total = $calculatedPoints['total'];

      // Team 7
      $calculatedPoints = $this->calculatePoints($composition->getTeam7(), $gamesPlayed,2);
      $composition->getTeam7()->mj = $calculatedPoints['mj'];
      $composition->getTeam7()->g = $calculatedPoints['g'];
      $composition->getTeam7()->n = $calculatedPoints['n'];
      $composition->getTeam7()->p = $calculatedPoints['p'];
      $composition->getTeam7()->total = $calculatedPoints['total'];

      // Team 8
      $calculatedPoints = $this->calculatePoints($composition->getTeam6(), $gamesPlayed,1);
      $composition->getTeam8()->mj = $calculatedPoints['mj'];
      $composition->getTeam8()->g = $calculatedPoints['g'];
      $composition->getTeam8()->n = $calculatedPoints['n'];
      $composition->getTeam8()->p = $calculatedPoints['p'];
      $composition->getTeam8()->total = $calculatedPoints['total'];
    }

    return $this->render('user/users/show.html.twig', [
        'user' => $user,
        'hasStarted' => $hasStarted
    ]);
  }

  /**
   * @Route("/admin/users/create", name="admin.users.create")
   * @param Request $request
   * @param UserPasswordEncoderInterface $passwordEncoder
   * @return RedirectResponse|Response
   */
  public function newUser(Request $request, UserPasswordEncoderInterface $passwordEncoder)
  {
    $user = new User();
    $form = $this->createForm(UserType::class, $user);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      // Encode the plain password
      $user->setPassword(
          $passwordEncoder->encodePassword(
              $user,
              $form->get('password')->getData()
          )
      );

      // Set default user role
      $user->setRoles(['ROLE_USER']);

      $this->em->persist($user);
      $this->em->flush();

      return $this->redirectToRoute('admin.users');
    }

    return $this->render('/admin/users/create.html.twig', [
        'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/admin/users/edit/{id}", name="admin.users.edit", methods={"GET|POST"})
   * @param User $user
   * @param Request $request
   * @param UserPasswordEncoderInterface $passwordEncoder
   * @return RedirectResponse|Response
   */
  public function edit(User $user, Request $request, UserPasswordEncoderInterface $passwordEncoder) {

    $form = $this->createForm(UserType::class, $user);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      // Encode the plain password
      $user->setPassword(
          $passwordEncoder->encodePassword(
              $user,
              $form->get('password')->getData()
          )
      );

      $this->em->flush();
      return $this->redirectToRoute('admin.users');
    }

    return $this->render('/admin/users/edit.html.twig', [
        'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/user/settings/edit-password/{id}", name="user.settings.editPassword", methods={"GET|POST"})
   * @param User $user
   * @param Request $request
   * @param UserPasswordEncoderInterface $passwordEncoder
   * @return RedirectResponse|Response
   */
  public function editPassword(User $user, Request $request, UserPasswordEncoderInterface $passwordEncoder) {

    $form = $this->createForm(UserPasswordType::class, $user);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      // Encode the plain password
      $user->setPassword(
          $passwordEncoder->encodePassword(
              $user,
              $form->get('password')->getData()
          )
      );

      $this->em->flush();
      return $this->redirectToRoute('user.index');
    }

    return $this->render('/user/settings/form.html.twig', [
        'form' => $form->createView()
    ]);
  }

  /**
   * @Route("admin/users/delete/{id}", name="admin.users.delete", methods={"DELETE"})
   * @param User $user
   * @param Request $request
   * @return RedirectResponse
   */
  public function deleteUser(User $user, Request $request) {
    if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->get('_token'))) {
      $this->em->remove($user);
      $this->em->flush();
    }

    return $this->redirectToRoute('admin.users');
  }

  private function calculatePoints($team, $gamesPlayed, $coeff) {
    $mj = 0;
    $g = 0;
    $n = 0;
    $p = 0;

    foreach ($gamesPlayed as $game) {

      // Si équipe 1
      if ($game->getTeam1()->getName() == $team->getName()) {
        $mj = $mj + 1;

        // Null
        if ($game->getScore1() > $game->getScore2()) {
          $g = $g + 1;
        }
        elseif ($game->getScore1() == $game->getScore2()) {
          $n = $n +1;
        }
        else {
          $p = $p +1;
        }
      }

      // Si équipe 2
      if ($game->getTeam2()->getName() == $team->getName()) {
        $mj = $mj + 1;

        // Null
        if ($game->getScore2() > $game->getScore1()) {
          $g = $g + 1;
        }
        elseif ($game->getScore2() == $game->getScore1()) {
          $n = $n +1;
        }
        else {
          $p = $p +1;
        }
      }
    }

    $total = ($g * $coeff) + ($n * ($coeff/2));

    return [
        'mj' => $mj,
        'g' => $g,
        'n' => $n,
        'p' => $p,
        'total' => $total
    ];
  }
}
