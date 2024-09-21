<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ArticleRepository $artRepo, Request $request): Response
    {
        // $latest_article = $artRepo->findOneBy([], ['id' => 'DESC']);
        // $articles = $artRepo->findAll();

        // return $this->render('home/home.html.twig', [
        //     'latest_article' => $latest_article,
        //     'articles' => $articles
        // ]);

        $page= $request->query->getInt('page', 1);
        $limit= 6;
        $latest_articles = $artRepo->findBy( [], [ 'id' => 'DESC' ], 4);

        $articles = $artRepo
            ->paginatorArticles($page, $limit);

        $totalPage = ceil( $articles->getTotalItemCount() / $limit );

        return $this->render('home/home.html.twig', [
            'articles' => $articles,
            'totalPage' => $totalPage,
            'page' => $page,
            'latest_articles' => $latest_articles
        ]);
    }

    #[Route('/show/{slug}-{id}', name: 'show', requirements: ['id' => '\d+', 'slug' => '[a-z0-9-]+' ])]
    public function show(ArticleRepository $artRepo, int $id, string $slug, Article $article) {

        $latest_article = $artRepo->findOneBy(['id' => $id]);

        $comment = new Comment($article);
        $commentForm = $this->createForm(CommentType::class, $comment);

        return $this->render('home/show.html.twig', [
            'slug' => $slug,
            'id' => $id,
            'latest_article' => $latest_article,
            'commentForm' => $commentForm
        ]);
    }
}