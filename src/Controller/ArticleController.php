<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
{
    /**
     * @Route("/")
     *
     * @return Response
     */
    public function index()
    {
        return new Response('This is my page');
    }

    /**
     * @Route("/show/{slug}")
     *
     * @param $slug
     *
     * @return Response
     */
    public function show($slug)
    {
        return new Response(sprintf('this is show %d', $slug));
    }
}
