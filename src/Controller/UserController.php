<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PostsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Controller\SecurityController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


#[Route('/user')]
final class UserController extends AbstractController
{
    // #[Route(name: 'app_user_index', methods: ['GET'])]
    // public function index(UserRepository $userRepository): Response
    // {
    //     return $this->render('user/index.html.twig', [
    //         'users' => $userRepository->findAll(),
    //     ]);
    // }

    
    #[Route('/user/{id}', name: 'app_user_index', methods: ['GET'])]
    public function index(int $id, UserRepository $userRepository, PostsRepository $postsRepository): Response
    {
        $user = $userRepository->find($id);
    
        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        $posts = $postsRepository->findBy(['user' => $user], ['createdAt' => 'DESC']);

        return $this->render('user/index.html.twig', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (!$user->getProfilePicture()) {
                $user->setProfilePicture('./images/profil.png');
            }
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]

    public function show(int $id, UserRepository $userRepository, PostsRepository $postsRepository): Response
    {
        $user = $userRepository->find($id);
    
        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        $posts = $postsRepository->findBy(['user' => $user], ['createdAt' => 'DESC']);

        return $this->render('user/index.html.twig', [
            'user' => $user,
            'posts' => $posts,
        ]);}



    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $newPassword = $form->get('password')->getData();
            if (!empty($newPassword)) {
                $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
                $user->setPassword($hashedPassword);
            }


            // $profilePicture = $form->get('profilePicture')->getData();
            // if ($profilePicture) {
            //     $picture = uniqid() . '.' . $profilePicture->guessExtension();
            //     $profilePicture->move($this->getParameter('profile_pictures_directory'), $picture);
            //     $user->setProfilePicture($picture);
            // } elseif (!$user->getProfilePicture()) {
            //     $user->setProfilePicture('/uploads/profile_pictures/default.png');
            // }

            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->getPayload()->getString('_token'))) {

            if ($user->getProfilePicture()) {
                $profilePicturePath = $this->getParameter('kernel.project_dir') . '/public' . $user->getProfilePicture();
                if (file_exists($profilePicturePath)) {
                    unlink($profilePicturePath);
                }
            }

            $entityManager->remove($user);
            $entityManager->flush();

            $request->getSession()->invalidate();
            $this->container->get('security.token_storage')->setToken(null);
            
            return $this->redirectToRoute('app_logout');
        }

        return $this->redirectToRoute('home_page', [], Response::HTTP_SEE_OTHER);
    }
}
