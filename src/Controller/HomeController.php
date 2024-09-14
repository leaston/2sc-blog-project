<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ArticleRepository $artRepo): Response
    {
        $latest_article = $artRepo->findOneBy([], ['id' => 'DESC']);
        $articles = $artRepo->findAll();

        return $this->render('home/home.html.twig', [
            'latest_article' => $latest_article,
            'articles' => $articles
        ]);
        
    }
}
