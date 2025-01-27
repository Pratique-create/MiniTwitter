<?php

namespace App\Controller;

use App\Entity\Likes;
use App\Form\LikesType;
use App\Repository\LikesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/likes')]
final class LikesController extends AbstractController
{
    #[Route(name: 'add_like')]
    public function addLike($postId, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user){
            return $this->redirectToRoute('app_register');
        }

        $existingLike = $entityManager->getRepository(Likes::class)->findOneBy([
            'post' => $postId,
            'user' => $user,
        ]);
    
        if ($existingLike) {
            $entityManager->remove($existingLike);
            $entityManager->flush();
            return $this->json([
                'message' => 'Vous n’aimez plus ce post.',
                'status' => 'unliked']);
        }

        $like = new Likes();
        $like -> setPostId($postId);
        $like -> setUserId($user);

        $entityManager->persist($like);
        $entityManager->flush();

        return $this->json([
            'message' => 'Vous aimez ce post.',
            'status' => 'liked']);
    }

    #[Route(name:'show_like')]
    public function showNumberLike($postId, EntityManagerInterface $entityManager): Response
    {
        $numberLike = $entityManager->getRepository(Likes::class)->count(['post' => $postId,]);
        return $this->json(['likes' => $numberLike]);
    }

    // #[Route(name: 'app_likes_index', methods: ['GET'])]
    // public function index(LikesRepository $likesRepository): Response
    // {
    //     return $this->render('likes/index.html.twig', [
    //         'likes' => $likesRepository->findAll(),
    //     ]);
    // }

    // #[Route('/new', name: 'app_likes_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $like = new Likes();
    //     $form = $this->createForm(LikesType::class, $like);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->persist($like);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_likes_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('likes/new.html.twig', [
    //         'like' => $like,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'app_likes_show', methods: ['GET'])]
    // public function show(Likes $like): Response
    // {
    //     return $this->render('likes/show.html.twig', [
    //         'like' => $like,
    //     ]);
    // }

    // #[Route('/{id}/edit', name: 'app_likes_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, Likes $like, EntityManagerInterface $entityManager): Response
    // {
    //     $form = $this->createForm(LikesType::class, $like);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_likes_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('likes/edit.html.twig', [
    //         'like' => $like,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'app_likes_delete', methods: ['POST'])]
    // public function delete(Request $request, Likes $like, EntityManagerInterface $entityManager): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$like->getId(), $request->getPayload()->getString('_token'))) {
    //         $entityManager->remove($like);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('app_likes_index', [], Response::HTTP_SEE_OTHER);
    // }
}
