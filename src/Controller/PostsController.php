<?php

namespace App\Controller;

use App\Entity\Posts;
use App\Form\PostsType;
use App\Repository\CommentRepository;
use App\Repository\LikesRepository;
use App\Repository\PostsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\RetweetsRepository;
use SebastianBergmann\Diff\Line;

#[Route('/posts')]
final class PostsController extends AbstractController
{
    #[Route(name: 'app_posts_index', methods: ['GET'])]
    public function index(PostsRepository $postsRepository, UserRepository $userRepository, RetweetsRepository $retweetRepository, LikesRepository $likeRepository): Response
{

    $posts = $postsRepository->findAll();

    $retweetCounts = [];
    $likeCounts = [];
    foreach ($posts as $post) {
    $retweetCounts[$post->getId()] = $retweetRepository->countRt($post->getId());
    $likeCounts[$post->getId()] = $likeRepository->countLike($post->getId());
}

        return $this->render('posts/index.html.twig', [
            'posts' => $postsRepository->findAll(),
            'users' => $userRepository ->findAll(),
            'retweetCount' => $retweetCounts,
            'likeCount' => $likeCounts,
        ]);
    }

    #[Route('/new', name: 'app_posts_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_register');
        }

        $post = new Posts();
        $post->setUser($this->getUser());
        $form = $this->createForm(PostsType::class, $post);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('app_posts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('posts/new.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_posts_show', methods: ['GET'])]
    public function show(Posts $post, PostsRepository $postsRepository, RetweetsRepository $retweetRepository, LikesRepository $likeRepository ,CommentRepository $commentRepository): Response
    {
        $getCommment = $commentRepository->getComments($post->getId());
        $retweetCounts = $retweetRepository->countRt($post->getId());
        $likeCounts = $likeRepository->countLike($post->getId());


        return $this->render('posts/show.html.twig', [
            'post' => $post,
            'comments' => $getCommment,
            'retweetCount' => $retweetCounts,
            'likeCount' => $likeCounts,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_posts_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Posts $post, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PostsType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_posts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('posts/edit.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_posts_delete', methods: ['POST'])]
    public function delete(Request $request, Posts $post, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_posts_index', [], Response::HTTP_SEE_OTHER);
    }
}
