<?php

namespace App\Controller;

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

//    dd($user);

    return $this->render('user/users/show.html.twig', [
        'user' => $user
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
}
