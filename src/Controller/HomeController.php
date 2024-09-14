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
        $article = $artRepo->findOneBy([], ['id' => 'DESC']);

        return $this->render('home/home.html.twig', [
            'article' => $article,
        ]);
        
    }
}
