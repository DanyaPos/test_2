<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'article_list')]
    public function list(): Response
    {
        $articles = $this->entityManager->getRepository(Article::class)->findAll();

        return $this->render('article/list.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/{slug}', name: 'article_show')]
    public function show(string $slug): Response
    {
        $article = $this->entityManager->getRepository(Article::class)->findOneBy(['slug' => $slug]);

        if (!$article) {
            throw $this->createNotFoundException('Статья не найдена');
        }

        $article->setViews($article->getViews() + 1);
        $this->entityManager->flush();

        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }
}
