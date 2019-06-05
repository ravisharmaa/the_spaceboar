<?php

namespace App\Controller;

use App\Services\MarkdownHelper;
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
     * @param MarkdownHelper $markdownHelper
     *
     * @return Response
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function show($slug, MarkdownHelper $markdownHelper)
    {
        $comments = [
            'some random dymmy text',
        ];

        $articleContent = <<<EOF
                **th** isahjfhskhfkasjhdfkjashdfkjashdfksakdfhasjkhdfkashfkjshdfkjashfjkahsjkdfhjasf
                asdfasdfjalskfjlaksfjdklajflkasjdflkjaslkfjsajflkasjdfkljsdalkfjaslkfjlkasjdflakjsfdlkjasldfkja
                **sadfklaf** 
EOF;

        return $this->render('articles/show.html.twig', [
            'comments' => $comments,
            'articleContent' => $markdownHelper->parse($articleContent),
            'slug' => $slug,
            'title' => 'Hello world',
        ]);
    }
}
