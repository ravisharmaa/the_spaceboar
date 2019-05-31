<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route ("/", name="homepage")
     *
     * @return Response
     */
    public function index()
    {
        return $this->render('articles/index.html.twig');
    }

    /**
     * @Route ("/show/{slug}", name="show_article")
     *
     * @param $slug
     *
     * @return Response
     */
    public function show($slug)
    {
        $comments = [
            'some random dymmy text'
        ];

        return $this->render('articles/show.html.twig', [
            'comments' => $comments,
            'slug' => $slug,
            'title'=>'Hello world'
        ]);
    }
}
