<?php


namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleFavoritesController extends AbstractController
{
    /**
     * @Route ("/articles/{slug}/favorites" , name="article_favorites_store", methods={"POST"})
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function store()
    {
        return $this->json(['hearts'=> rand(5,10)]);
    }
}