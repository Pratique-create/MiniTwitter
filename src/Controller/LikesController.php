<?php



namespace App\Controller;

use App\Entity\Likes;
use App\Entity\Posts;
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
    #[Route('/add/{id}',name: 'app_like')]
    public function addLike(Posts $post, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user){
            return $this->redirectToRoute('app_register');
        }

        $existingLike = $entityManager->getRepository(Likes::class)->findOneBy([
            'post' => $post,
            'user' => $user,
        ]);
    
        if ($existingLike) {
            $entityManager->remove($existingLike);
            $entityManager->flush();
            $this->addFlash('info', 'Vous avez annulé votre Like.');
        }

        else {
            $like = new Likes();
            $like -> setPost($post);
            $like -> setUser($user);
    
            $entityManager->persist($like);
            $entityManager->flush();
    
            $this->addFlash('success', 'Vous avez like ce message !');
        }

        return $this->redirectToRoute('app_posts_index');
    }

    #[Route(name:'show_like')]
    public function showNumberLike($postId, EntityManagerInterface $entityManager): Response
    {
        $numberLike = $entityManager->getRepository(Likes::class)->count(['post' => $postId,]);
        return $this->json(['likes' => $numberLike]);
    }

}