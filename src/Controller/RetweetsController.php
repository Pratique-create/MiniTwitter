<?php

namespace App\Controller;

use App\Entity\Retweets;
use App\Form\RetweetsType;
use App\Repository\RetweetsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/retweets')]
final class RetweetsController extends AbstractController
{
    #[Route(name: 'app_retweets_index', methods: ['GET'])]
    public function index(RetweetsRepository $retweetsRepository): Response
    {
        return $this->render('retweets/index.html.twig', [
            'retweets' => $retweetsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_retweets_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $retweet = new Retweets();
        $form = $this->createForm(RetweetsType::class, $retweet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($retweet);
            $entityManager->flush();

            return $this->redirectToRoute('app_retweets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('retweets/new.html.twig', [
            'retweet' => $retweet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_retweets_show', methods: ['GET'])]
    public function show(Retweets $retweet): Response
    {
        return $this->render('retweets/show.html.twig', [
            'retweet' => $retweet,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_retweets_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Retweets $retweet, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RetweetsType::class, $retweet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_retweets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('retweets/edit.html.twig', [
            'retweet' => $retweet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_retweets_delete', methods: ['POST'])]
    public function delete(Request $request, Retweets $retweet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$retweet->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($retweet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_retweets_index', [], Response::HTTP_SEE_OTHER);
    }
}
